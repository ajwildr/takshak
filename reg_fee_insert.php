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

  // Array of event_id => reg_fee
$event_fees = [
    1 => 400,
    2 => 300,
    3 => 100,
    4 => 100,
    5 => 150,
    6 => 150,
    7 => 100,
    8 => 50,
    9 => 100
];

// Loop through the array and update the table
foreach ($event_fees as $event_id => $reg_fee) {
    // SQL query to update the reg_fee for the corresponding event_id
    $sql = "UPDATE event_limit SET reg_fee = $reg_fee WHERE event_id = $event_id";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Event ID $event_id updated successfully with reg_fee $reg_fee.<br>";
    } else {
        echo "Error updating Event ID $event_id: " . $conn->error . "<br>";
    }
}

// Close the connection
$conn->close();
?>
