<?php
$id=$_GET['id'];
include('connect.php');
$update_status="UPDATE individual_events set status='deleted' where reg_id ='$id'";
if($conn->query($update_status))
    {
        header("delete_participant.php");
    }
else{
    echo($conn->error);

}
?>