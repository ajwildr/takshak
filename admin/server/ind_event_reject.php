<?php
session_start();
if(isset($_SESSION['user']))
{
include('connect.php');
$id=$_GET['id'];
$update_status="UPDATE individual_events set status='rejected' where reg_id ='$id'";
if($conn->query($update_status))
    {
        if($_SESSION['user']=="super_user")
            {
              header("Location:/takshak/admin/admin.php");
            }
        else{
            header("Location:/takshak/admin/coordinator.php");
        }
    }
else{
    echo($conn->error);

    }
}
else{
    header("restricted.php");
}
?>