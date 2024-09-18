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

$sql = "DELETE FROM event_limit WHERE event_id IN (87, 1000)";

if (mysqli_query($conn, $sql)) {
    echo "Records deleted successfully.";
} else {
    echo "Error deleting records: " . mysqli_error($conn);
}

// Close the connection if you're done with it
mysqli_close($conn);
?>
