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

$sql = "
UPDATE event_limit
SET current_reg = 0,
    reg_limit = CASE
        WHEN event_id = 1 THEN 80
        WHEN event_id = 2 THEN 45
        WHEN event_id = 3 THEN 45
        WHEN event_id = 4 THEN 60
        WHEN event_id = 5 THEN 30
        WHEN event_id = 7 THEN 30
        WHEN event_id = 8 THEN 100
        WHEN event_id = 9 THEN 100
        ELSE reg_limit
    END
WHERE event_id IN (1, 2, 3, 4, 5, 7, 8, 9)
";

if (mysqli_query($conn, $sql)) {
    echo "Records updated successfully.";
} else {
    echo "Error updating records: " . mysqli_error($conn);
}

// Close the connection if you're done with it
mysqli_close($conn);
?>

