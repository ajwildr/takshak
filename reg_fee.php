<?php
// Include the database connection
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

// SQL query to add the column 'reg_fee' with default value 0
$sql = "ALTER TABLE event_limit ADD COLUMN reg_fee INT DEFAULT 0";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Column 'reg_fee' added successfully.";
} else {
    echo "Error adding column: " . $conn->error;
}

// Close the connection
$conn->close();
?>
