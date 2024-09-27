<?php
// Include the database connection file
include("connect.php");

// SQL query to update reg_limit to current_reg
$sql = "UPDATE event_limit SET reg_limit = current_reg";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Records updated successfully!";
} else {
    echo "Error updating records: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
