<?php
try {
    // Connect using PDO
    $conn = new PDO("sqlsrv:server = tcp:takshak.database.windows.net,1433; Database = thakshak", "thakshak1", "takshak@123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful using PDO!";
} catch (PDOException $e) {
    echo "Error connecting to SQL Server: " . $e->getMessage();
    die();
}
?>
