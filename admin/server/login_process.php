<?php
include('connect.php');
session_start(); // Start session at the beginning

$uname = $_POST['username'];
$pass = $_POST['password'];

// Execute the SQL query
$sel_query = "SELECT pass, event_name FROM users WHERE user_name='$uname'";
$execute = $conn->query($sel_query);
$user_details = $execute->fetch_assoc();

// Debugging: Show user details


if ($user_details['event_name'] == 'admin') {
    // Set session variable for admin
    $_SESSION['user'] = "super_user";
    // Use JavaScript to redirect after setting the session
    echo "<script>
        setTimeout(function() {
            window.location.href = '/admin/admin.php';
        }, 3000);
    </script>";
} elseif ($user_details['event_name'] == null) {
    // Redirect to invalid credentials page if no event_name found
    echo "<script>window.location.href='invalid_credentials.php';</script>";
} else {
    // Set session variables for coordinator
    $_SESSION['user'] = "coordinator";
    $_SESSION['event_name'] = $user_details['event_name'];
    // Use JavaScript to redirect after setting the session
    echo "<script>
        setTimeout(function() {
            window.location.href = '/takshak/admin/coordinator.php';
        }, 3000);
    </script>";
    echo($user_details['event_name']); // Debugging: Output the event name
}
exit; // Make sure no further code is executed after the redirect
?>
