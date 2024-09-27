<?php
// Include the database connection file
include("connect.php");

// Set headers for file download
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="database_backup_' . date('Y-m-d_H-i-s') . '.sql"');

// Get all tables in the database
$tables = array();
$result = mysqli_query($conn, "SHOW TABLES");

while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Output the content directly to the browser
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

// Close the database connection
mysqli_close($conn);
?>
