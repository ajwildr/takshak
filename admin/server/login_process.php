<?php
include('connect.php');
session_start(); // Start session before any output is sent

$uname = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute the SQL query safely using prepared statements to prevent SQL injection
$sel_query = $conn->prepare("SELECT pass, event_name FROM users WHERE user_name = ?");
$sel_query->bind_param('s', $uname); // 's' indicates a string type
$sel_query->execute();
$result = $sel_query->get_result();
$user_details = $result->fetch_assoc();

if ($user_details) {
    // Verify the password (assuming it's hashed in the database)
    if (password_verify($pass, $user_details['pass'])) {
        if ($user_details['event_name'] == 'admin') {
            $_SESSION['user'] = "super_user";
            // Use relative paths for redirection
            header("Location: /admin/admin.php");
        } else {
            $_SESSION['user'] = "coordinator";
            $_SESSION['event_name'] = $user_details['event_name'];
            header("Location: /admin/coordinator.php");
        }
    } else {
        // Invalid password
        header("Location: invalid_credentials.php");
    }
} else {
    // Invalid username
    header("Location: invalid_credentials.php");
}
exit; // Ensure no further processing occurs after redirection
?>
