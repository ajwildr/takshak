<?php
include('connect.php');
session_start();
$uname=$_POST['username'];
$pass=$_POST['password'];
$sel_query="SELECT pass,event_name from users where user_name='$uname'";
$execute=$conn->query($sel_query);
$user_details=$execute->fetch_assoc();
var_dump($user_details);
if($user_details['event_name']=='admin')
{
    $_SESSION['user']="super_user";
    // header("Location:/takshak/admin/admin.php");
    echo "<script>window.location.href='/admin/admin.php';</script>";
}
else if($user_details['event_name']==null){
    header("Location:invalid_credentials.php");
}
else{
    $_SESSION['user']="coordinator";
    $_SESSION['event_name']=$user_details['event_name'];
    header("Location:/takshak/admin/coordinator.php");
    echo($user_details['event_name']);
}



?>
