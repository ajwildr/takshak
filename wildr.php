<?php
echo("ha");
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

// Query to select all data from the users table
$query = "SELECT id, event_name, user_name, pass, event_id FROM users";

// Execute the query
$result = $conn->query($query);

// Check if there are any records returned
if ($result->num_rows > 0) {
    // Output the data in table format
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Event Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Event ID</th>
            </tr>";

    // Fetch each row from the result
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['event_name'] . "</td>
                <td>" . $row['username'] . "</td>
                <td>" . $row['pass'] . "</td>
                <td>" . $row['event_id'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No records found!";
}

// Close the database connection
$conn->close();
?>
