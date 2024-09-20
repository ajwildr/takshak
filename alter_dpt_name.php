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
echo "Connected successfully<br>";

// Function to display the table structure
function displayTableStructure($conn, $tableName) {
    $sql = "SHOW COLUMNS FROM $tableName";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Field"] . "</td><td>" . $row["Type"] . "</td><td>" . $row["Null"] . "</td><td>" . $row["Key"] . "</td><td>" . $row["Default"] . "</td><td>" . $row["Extra"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No columns found in the table.";
    }
}

// Display table structure before modifying
echo "<h3>Table structure before modification:</h3>";
displayTableStructure($conn, 'group_event'); // Changed to group_event

// SQL query to modify the length of dept_name column
$sql = "ALTER TABLE group_event MODIFY dept_name VARCHAR(50)"; // Changed to group_event

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "<p>Column length of dept_name modified successfully.</p>";
} else {
    echo "<p>Error modifying column: " . $conn->error . "</p>";
}

// Display table structure after modifying
echo "<h3>Table structure after modification:</h3>";
displayTableStructure($conn, 'group_event'); // Changed to group_event

// Close the connection
$conn->close();
?>
