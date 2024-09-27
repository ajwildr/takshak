<?php
// Include the database connection file


// Set headers to trigger file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="database_backup_' . date('Y-m-d_H-i-s') . '.sql"');
header('Pragma: no-cache');
header('Expires: 0');

// Output buffering to ensure everything is sent as one download
ob_start();

//$hostname = "testing123ajai-server.mysql.database.azure.com";
$username = "dglktgierk";
$password = 'EzVMnQnSNI$kJwT3'; // Ensure the password is correct
$database = "thakshak"; // Ensure this matches the database name

// Initialize MySQLi
$conn = mysqli_init();

// Connect to the MySQL server
if (!mysqli_real_connect($conn, $hostname, $username, $password, $database, 3306)) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get all tables in the database
$tables = array();
$result = mysqli_query($conn, "SHOW TABLES");

while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Output the content directly to the download file
foreach ($tables as $table) {
    // Get the CREATE TABLE statement
    $createTableResult = mysqli_query($conn, "SHOW CREATE TABLE $table");
    $createTableRow = mysqli_fetch_row($createTableResult);
    
    // Output the CREATE TABLE statement
    echo "\n\n" . $createTableRow[1] . ";\n\n";

    // Get all table data
    $tableDataResult = mysqli_query($conn, "SELECT * FROM $table");
    
    while ($row = mysqli_fetch_assoc($tableDataResult)) {
        $columns = array_keys($row);
        $values = array_values($row);

        // Format the INSERT INTO statement
        $columns = implode("`, `", $columns);
        $values = array_map(function($value) use ($conn) {
            return "'" . mysqli_real_escape_string($conn, $value) . "'";
        }, $values);
        $values = implode(", ", $values);
        
        $insertSQL = "INSERT INTO `$table` (`$columns`) VALUES ($values);\n";
        
        // Output the INSERT INTO statement
        echo $insertSQL;
    }
}

// Flush the output buffer to ensure all content is sent to the browser for download
ob_end_flush();

// Close the database connection
mysqli_close($conn);
?>
