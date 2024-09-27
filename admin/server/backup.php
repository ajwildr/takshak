<?php
// Include the database connection file
include("connect.php");

// Set headers to trigger file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="database_backup_' . date('Y-m-d_H-i-s') . '.sql"');
header('Pragma: no-cache');
header('Expires: 0');

// Output buffering to ensure everything is sent as one download
ob_start();

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
        $colum
