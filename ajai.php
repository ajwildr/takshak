<?php
// Database configuration
$hostname = "takshak.database.windows.net";
$username = "thakshak1";
$password = "takshak@123";
$database = "thakshak";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful!<br>";
}

// SQL to create table if it doesn't exist
$create_table = "CREATE TABLE IF NOT EXISTS demo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_table) === TRUE) {
    echo "Table 'demo' created successfully or already exists<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert sample data
$insert_data = "INSERT INTO demo (name, email) VALUES 
    ('John Doe', 'john@example.com'),
    ('Jane Smith', 'jane@example.com')";

if ($conn->query($insert_data) === TRUE) {
    echo "Sample data inserted successfully<br>";
} else {
    echo "Error inserting data: " . $conn->error . "<br>";
}

// Display data
$select_data = "SELECT * FROM demo";
$result = $conn->query($select_data);

if ($result->num_rows > 0) {
    echo "<h2>Table Contents:</h2>";
    echo "<table border='1' style='border-collapse: collapse; margin: 15px;'>";
    echo "<tr>
            <th style='padding: 8px;'>ID</th>
            <th style='padding: 8px;'>Name</th>
            <th style='padding: 8px;'>Email</th>
            <th style='padding: 8px;'>Created At</th>
          </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td style='padding: 8px;'>" . $row["id"] . "</td>
                <td style='padding: 8px;'>" . $row["name"] . "</td>
                <td style='padding: 8px;'>" . $row["email"] . "</td>
                <td style='padding: 8px;'>" . $row["created_at"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No data found in the table<br>";
}

// Close connection
$conn->close();
?>
