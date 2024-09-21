<?php
session_start();

// Include the database connection
include('connect.php');

// Function to retrieve the user's IP address accurately
function getUserIP() {
    $ip_keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];

    foreach ($ip_keys as $key) {
        if (!empty($_SERVER[$key])) {
            // In case of multiple IP addresses, take the first one
            $ip = explode(',', $_SERVER[$key])[0];
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    return 'UNKNOWN';
}

// Function to fetch location data using ipinfo.io API
function getLocationData($ip_address, $access_token) {
    $api_url = "https://ipinfo.io/{$ip_address}/json?token={$access_token}";

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Set timeout for the request

    $response = curl_exec($ch);

    if ($response === false) {
        // Handle cURL error
        $error = curl_error($ch);
        curl_close($ch);
        // Log the error or handle it as needed
        return ['city' => 'Unknown', 'region' => 'Unknown', 'country' => 'Unknown'];
    }

    curl_close($ch);

    // Decode the JSON response
    $ip_data = json_decode($response);

    if ($ip_data === null) {
        // Handle JSON decode error
        return ['city' => 'Unknown', 'region' => 'Unknown', 'country' => 'Unknown'];
    }

    return [
        'city'    => isset($ip_data->city) ? $ip_data->city : 'Unknown',
        'region'  => isset($ip_data->region) ? $ip_data->region : 'Unknown',
        'country' => isset($ip_data->country) ? $ip_data->country : 'Unknown'
    ];
}

// Retrieve event ID from session
if (!isset($_SESSION['event_id'])) {
    die("Event ID not set in session.");
}

$event_id = $_SESSION['event_id'];

// Prepare the select query to get the event name
$select_query = "SELECT event_name FROM event_details WHERE event_id = ?";

if ($stmt = $conn->prepare($select_query)) {
    // Assuming event_id is a string. If it's an integer, change "s" to "i"
    $stmt->bind_param("s", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event_details = $result->fetch_assoc();
    $stmt->close();
} else {
    die("Error preparing the select statement: " . $conn->error);
}

if (!isset($event_details['event_name'])) {
    die("Event name not found for the given event ID.");
}

$event_name = $event_details['event_name'];

// Retrieve and sanitize form inputs
$name       = isset($_POST['name']) ? trim($_POST['name']) : '';
$clg        = isset($_POST['collegename']) ? trim($_POST['collegename']) : '';
$dpt_name   = isset($_POST['department']) ? trim($_POST['department']) : '';
$mail       = isset($_POST['email']) ? trim($_POST['email']) : '';
$phn        = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$trans_id   = isset($_POST['transaction']) ? trim($_POST['transaction']) : '';

// Basic validation (you can enhance this as needed)
if (empty($name) || empty($clg) || empty($dpt_name) || empty($mail) || empty($phn) || empty($trans_id)) {
    die("Please fill in all required fields.");
}

// Get user's IP address
$ip_address = getUserIP();
$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

// Your ipinfo.io access token (replace with your actual token)
$access_token = 'YOUR_ACCESS_TOKEN_HERE';

// Fetch location data
$location = getLocationData($ip_address, $access_token);
$city = $location['city'];
$region = $location['region'];
$country = $location['country'];

// Prepare the SQL query for reg_logs with placeholders
$insert_reg_logs = "INSERT INTO reg_logs 
    (name, event_id, clg_name, dept_name, mail, phone, transaction_id, event_name, user_ip, user_agent, city, region, country, time_of_access) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

// Prepare the statement
$stmt1 = $conn->prepare($insert_reg_logs);

if ($stmt1 === false) {
    die("Error preparing reg_logs statement: " . $conn->error);
}

// Bind the parameters to the statement
// Adjust the types based on your database schema
// Assuming event_id is a string. If it's an integer, change the second "s" to "i"
$stmt1->bind_param(
    "sisssssssssss",
    $name,
    $event_id,
    $clg,
    $dpt_name,
    $mail,
    $phn,
    $trans_id,
    $event_name,
    $ip_address,
    $user_agent,
    $city,
    $region,
    $country
);

// Execute the prepared statement
if (!$stmt1->execute()) {
    // Log the error or handle it as needed
    die("Error inserting into reg_logs: " . $stmt1->error);
}

// Close the statement
$stmt1->close();

// Prepare the insert query for individual_events
$insert_individual_events = "INSERT INTO individual_events 
    (clg_name, dept_name, mail, phone, transaction_id, event_name, event_id, name) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt2 = $conn->prepare($insert_individual_events)) {
    // Bind the form values to the statement
    // Adjust the types based on your database schema
    // Assuming all fields are strings. If not, adjust accordingly (e.g., "i" for integers)
    $stmt2->bind_param("ssssssss", $clg, $dpt_name, $mail, $phn, $trans_id, $event_name, $event_id, $name);

    try {
        // Execute the insert query
        if ($stmt2->execute()) {
            // Prepare the update query
            $update_limit = "UPDATE event_limit SET current_reg = current_reg + 1 WHERE event_id = ?";
            if ($stmt_update = $conn->prepare($update_limit)) {
                // Bind the event ID to the update statement
                $stmt_update->bind_param("s", $event_id);

                if ($stmt_update->execute()) {
                    // Close the update statement
                    $stmt_update->close();
                    // Close the individual_events statement
                    $stmt2->close();
                    // Close the database connection
                    $conn->close();
                    // Redirect to success page
                    header("Location: reg_success.php");
                    exit();
                } else {
                    // Handle the update execution error
                    $stmt_update->close();
                    $stmt2->close();
                    $conn->close();
                    header("Location: reg_failed.php");
                    exit();
                }
            } else {
                // Handle the preparation error for update_limit
                $stmt2->close();
                $conn->close();
                header("Location: reg_failed.php");
                exit();
            }
        } else {
            // Handle the execution error for individual_events
            $stmt2->close();
            $conn->close();
            header("Location: reg_failed.php");
            exit();
        }
    } catch (Throwable $e) {
        // Catch any errors and redirect to the failed page
        $stmt2->close();
        $conn->close();
        header("Location: reg_failed.php");
        exit();
    }
} else {
    die("Error preparing individual_events statement: " . $conn->error);
}

// Close the database connection (if not already closed)
if ($conn->ping()) {
    $conn->close();
}
?>
