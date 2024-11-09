<?php
// Connection information
$serverName = "tcp:takshak.database.windows.net,1433";
$connectionInfo = [
    "UID" => "thakshak1",
    "pwd" => "takshak@123",
    "Database" => "thakshak",
    "LoginTimeout" => 30,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
];

// Connect using sqlsrv
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    echo "Connection successful using SQL Server Extension!";
} else {
    echo "Connection failed: ";
    die(print_r(sqlsrv_errors(), true));
}
?>
