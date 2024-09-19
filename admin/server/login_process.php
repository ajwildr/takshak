<?php 
session_start();

include('connect.php'); // Include your database connection

$uname = $_POST['username'];
$pass = $_POST['password'];

// Prepare the SQL query with placeholders
$sel_query = "SELECT pass, event_name FROM users WHERE user_name = ?";

if ($stmt = $conn->prepare($sel_query)) {
    // Bind the user input to the prepared statement
    $stmt->bind_param("s", $uname); // "s" stands for string type

    // Execute the prepared statement
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();
    $user_details = $result->fetch_assoc();

    // Check the user details and set session variables
    if ($user_details['event_name'] == 'admin') {
        $_SESSION['user'] = "super_user";

        // Use JavaScript to redirect after setting the session
        echo "<script>
            alert('updated');
            setTimeout(function() {
                window.location.href = '/admin/aaddmmiinn.php';
            }, 800);
        </script>";
    } elseif ($user_details['event_name'] == null) {
        // Redirect to invalid credentials page if no event_name found
        echo "<script>window.location.href='invalid_credentials.php';</script>";
    } else {
        $_SESSION['user'] = "coordinator";
        $_SESSION['event_name'] = $user_details['event_name'];

        // Use JavaScript to redirect after setting the session
        echo "<script>
            setTimeout(function() {
                window.location.href = '/admin/coordinator.php';
            }, 800);
        </script>";

        echo($user_details['event_name']); // Debugging: Output the event name
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

exit; // Make sure no further code is executed after the redirect
?>
