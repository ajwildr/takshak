<?php
include('connect.php');
$id=$_GET['id'];
$delete_query="DELETE from event_details  where event_id='$id'";
echo($delete_query);
if($conn->query($delete_query))
    {   header("Location:event_list.php");
        
    }
else{
    echo($conn->error);

}
?>