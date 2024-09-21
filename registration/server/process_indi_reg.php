<?php 
session_start();

$event_id = $_SESSION['event_id'];

include('connect.php');

// Prepare the select query to get the event name
$select_strength = "SELECT event_name FROM event_details WHERE event_id = ?";

if ($stmt = $conn->prepare($select_strength)) {
    $stmt->bind_param("s", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event_details = $result->fetch_assoc();
    $stmt->close();
}

$event_name = $event_details['event_name'];

// Taking values from the form
$name = $_POST['name'];
$clg = $_POST['collegename'];
$dpt_name = $_POST['department'];
$mail = $_POST['email'];
$phn = $_POST['phone'];
$trans_id = $_POST['transaction'];

// Fetch IP address and details
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Use a reliable IP info service
$ip_data = @json_decode(file_get_contents("http://api.ipstack.com/{$ip_address}?access_key=YOUR_ACCESS_KEY"));

if ($ip_data && isset($ip_data->city, $ip_data->region, $ip_data->country)) {
    $city = $ip_data->city;
    $region = $ip_data->region;
    $country = $ip_data->country;
} else {
    // Default values if API fails
    $city = "Unknown";
    $region = "Unknown";
    $country = "Unknown";
}

// Prepare the SQL query with placeholders
$sql1 = "INSERT INTO reg_logs 
        (name, event_id, clg_name, dept_name, mail, phone, transaction_id, event_name, user_ip, user_agent, city, region, country, time_of_access) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt1 = $conn->prepare($sql1);

if ($stmt1 === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt1->bind_param("sisssssssssss", $name, $event_id, $clg, $dpt_name, $mail, $phn, $trans_id, $event_name, $ip_address, $user_agent, $city, $region, $country);

if ($stmt1->execute()) {
    echo "Record inserted successfully.";
} else {
    echo "Error inserting record: " . $stmt1->error;
}

$stmt1->close();

// Prepare the insert query
$insert_query = "INSERT INTO individual_events (clg_name, dept_name, mail, phone, transaction_id, event_name, event_id, name) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($insert_query)) {
    $stmt->bind_param("ssssssss", $clg, $dpt_name, $mail, $phn, $trans_id, $event_name, $event_id, $name);

    try {
        if ($stmt->execute()) {
            $update_limit = "UPDATE event_limit SET current_reg = current_reg + 1 WHERE event_id = ?";
            if ($stmt_update = $conn->prepare($update_limit)) {
                $stmt_update->bind_param("s", $event_id);
                if ($stmt_update->execute()) {
                    $stmt_update->close();
                    mysqli_close($conn);
                    echo "<script>window.location.href = 'reg_sucess.php';</script>";
                } else {
                    mysqli_close($conn);
                    echo "<script>window.location.href = 'reg_sucess.php';</script>";
                }
            }
        } else {
            mysqli_close($conn);
            echo "<script>window.location.href = 'reg_failed.php';</script>";
        }
    } catch (Throwable $e) {
        echo "<script>window.location.href = 'reg_failed.php';</script>";
    }

    $stmt->close();
}

$conn->close(); 
?>
