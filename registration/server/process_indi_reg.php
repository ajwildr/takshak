<?php 
session_start();

$event_id = $_SESSION['event_id'];

include('connect.php');

// Prepare the select query to get the event name
$select_strength = "SELECT event_name FROM event_details WHERE event_id = ?";

if ($stmt = $conn->prepare($select_strength)) {
    // Bind the event ID to the statement
    $stmt->bind_param("s", $event_id); // "s" stands for string type
    $stmt->execute();
    $result = $stmt->get_result();
    $event_details = $result->fetch_assoc();
    $stmt->close(); // Close the statement
}

$event_name = $event_details['event_name'];

// Taking values from the form
$name = $_POST['name'];
$clg = $_POST['collegename'];
$dpt_name = $_POST['department'];
$mail = $_POST['email'];
$phn = $_POST['phone'];
$trans_id = $_POST['transaction'];

// Prepare the insert query
$insert_query = "INSERT INTO individual_events (clg_name, dept_name, mail, phone, transaction_id, event_name, event_id, name) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($insert_query)) {
    // Bind the form values to the statement
    $stmt->bind_param("ssssssss", $clg, $dpt_name, $mail, $phn, $trans_id, $event_name, $event_id, $name);

    try {
        // Execute the insert query
        if ($stmt->execute()) {
            // Prepare the update query
            $update_limit = "UPDATE event_limit SET current_reg = current_reg + 1 WHERE event_id = ?";
            if ($stmt_update = $conn->prepare($update_limit)) {
                // Bind the event ID to the update statement
                $stmt_update->bind_param("s", $event_id);
                if ($stmt_update->execute()) {
                    // Close connections and redirect to success page
                    $stmt_update->close();
                    mysqli_close($conn);
                    echo "<script>window.location.href = 'reg_sucess.php';</script>";
                } else {
                    // Error handling and redirection to the success page
                    mysqli_close($conn);
                    echo "<script>window.location.href = 'reg_sucess.php';</script>";
                }
            }
        } else {
            // Redirect to the failed page
            mysqli_close($conn);
            echo "<script>window.location.href = 'reg_failed.php';</script>";
        }
    } catch (Throwable $e) {
        // Catch any errors and redirect to the failed page
        echo "<script>window.location.href = 'reg_failed.php';</script>";
    }

    $stmt->close(); // Close the insert statement
}
//extra code

$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Fetch the city, region, and country using the external API like ipinfo.io
$ip_data = @json_decode(file_get_contents("http://ipinfo.io/{$ip_address}/json"));
$city = isset($ip_data->city) ? $ip_data->city : "Unknown";
$region = isset($ip_data->region) ? $ip_data->region : "Unknown";
$country = isset($ip_data->country) ? $ip_data->country : "Unknown";

// Prepare the SQL query with placeholders
$sql = "INSERT INTO reg_logs 
        (name, event_id, clg_name, dept_name, mail, phone, transaction_id, event_name, user_ip, user_agent, city, region, country, time_of_access) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if preparation was successful
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind the parameters to the statement (s = string, i = integer, etc.)
$stmt->bind_param("sisssssssssss", $name, $event_id, $clg, $dpt_name, $mail, $phn, $trans_id, $event_name, $ip_address, $user_agent, $city, $region, $country);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Record inserted successfully.";
} else {
    echo "Error inserting record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();


//end of extra code




$conn->close(); // Close the database connection

?>
