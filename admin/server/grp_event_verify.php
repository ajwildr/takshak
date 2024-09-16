<?php
session_start();
if(isset($_SESSION['user']))
{
include('connect.php');
$id=$_GET['id'];
$update_status="UPDATE group_event set status='verified' where reg_id ='$id'";
if($conn->query($update_status))
    {   if($_SESSION['user']=="super_user")
            {
               echo "<script>
        setTimeout(function() {
            window.location.href = '/admin/admin.php';
        }, 1500);
    </script>";
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
