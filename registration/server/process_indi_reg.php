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

$conn->close(); // Close the database connection

?>
