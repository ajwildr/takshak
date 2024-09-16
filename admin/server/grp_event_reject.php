<?php
session_start();
if(isset($_SESSION['user']))
{
include('connect.php');
$id=$_GET['id'];
//query to get event_id
$get_event_id="SELECT event_id from group_event where reg_id='$id'";
$data=$conn->query($get_event_id);
$event_detail=$data->fetch_assoc();
$event_id=$event_detail['event_id'];
//end of query to get event_id
$update_status="UPDATE group_event set status='rejected' where reg_id ='$id'";
if($conn->query($update_status))
    {
        if($_SESSION['user']=="super_user")
            { $update_limit="UPDATE event_limit set current_reg=current_reg-1 where event_id='$event_id'";
                $conn->query($update_limit);
              header("Location:/takshak/admin/admin.php");
            }
        else{
            $update_limit="UPDATE event_limit set current_reg=current_reg-1 where event_id='$event_id'";
            $conn->query($update_limit);
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