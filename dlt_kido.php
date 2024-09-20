
<?php
$hostname = "testing123ajai-server.mysql.database.azure.com";
$username = "dglktgierk";
$password = 'EzVMnQnSNI$kJwT3'; // Ensure the password is correct
$database = "thakshak"; // Ensure this matches the database name

// Initialize MySQLi
$conn = mysqli_init();

// Connect to the MySQL server
if (!mysqli_real_connect($conn, $hostname, $username, $password, $database, 3306)) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";
// Ensure this file initializes $conn with the database connection

// SQL query to delete rows from the individual_events table where mail starts with 'kido'
$dlt_query = "DELETE FROM group_event WHERE mail LIKE 'test%'";

if ($conn->query($dlt_query)) {
    echo "Deletion successful";
} else {
    // Print the error if the deletion fails
    echo "Deletion failed: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
