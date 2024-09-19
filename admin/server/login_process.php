<?php 
session_start();

include('connect.php'); // Include your database connection

$uname = $_POST['username'];
$pass = $_POST['password'];

echo "Starting script...<br>";
sleep(1); // Delay for debugging

// Prepare the SQL query with placeholders
$sel_query = "SELECT pass, event_name FROM users WHERE user_name = ?";

if ($stmt = $conn->prepare($sel_query)) {
    echo "Prepared statement created.<br>";
    sleep(1); // Delay for debugging
    
    // Bind the user input to the prepared statement
    $stmt->bind_param("s", $uname); // "s" stands for string type
    echo "Binding parameters...<br>";
    sleep(1); // Delay for debugging

    // Execute the prepared statement
    $stmt->execute();
    echo "Statement executed.<br>";
    sleep(1); // Delay for debugging

    // Get the result of the query
    $result = $stmt->get_result();
    $user_details = $result->fetch_assoc();
    
    // Debug output for fetched user details
    echo "Fetched user details: ";
    print_r($user_details);
    echo "<br>";
    sleep(1); // Delay for debugging
    echo "Stored password: " . $user_details['pass'] . " | Entered password: " . $pass . "<br>";

    if ($user_details) {
        // Verify the password using plain text comparison
        if ($pass == $user_details['pass']) {
            echo "Password verification successful.<br>";
            sleep(1); // Delay for debugging

            // Check if the user is admin or coordinator
            if ($user_details['event_name'] == 'admin') {
                $_SESSION['user'] = "super_user";
                echo "User is admin.<br>";
                sleep(1); // Delay for debugging

                // Delay the redirection
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '/admin/aaddmmiinn.php';
                    }, 2000); // Delay for 2 seconds before redirection
                </script>";
                echo "Redirecting to admin page...<br>";
            } elseif ($user_details['event_name'] == null) {
                // Redirect to invalid credentials page if no event_name found
                echo "No event_name found. Redirecting to invalid credentials page...<br>";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'invalid_credentials.php';
                    }, 2000); // Delay for 2 seconds before redirection
                </script>";
            } else {
                $_SESSION['user'] = "coordinator";
                $_SESSION['event_name'] = $user_details['event_name'];
                echo "User is coordinator.<br>";
                sleep(1); // Delay for debugging

                // Delay the redirection
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '/admin/coordinator.php';
                    }, 2000); // Delay for 2 seconds before redirection
                </script>";

                // Debugging: Output the event name
                echo "Event name: " . $user_details['event_name'] . "<br>";
            }
        } else {
            // If the password is incorrect, redirect to invalid credentials page
            echo "Password verification failed. Redirecting to invalid credentials page...<br>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'invalid_credentials.php';
                }, 2000); // Delay for 2 seconds before redirection
            </script>";
        }
    } else {
        // If the username is not found, redirect to invalid credentials page
        echo "User not found. Redirecting to invalid credentials page...<br>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'invalid_credentials.php';
            }, 2000); // Delay for 2 seconds before redirection
        </script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

echo "Script finished.<br>";
exit; // Ensure no further code is executed after the redirect
?>
