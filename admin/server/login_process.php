<?php
include('connect.php');
$uname=$_POST['username'];
$pass=$_POST['password'];
$sel_query="SELECT pass,event_name from users where user_name='$uname'";
$execute=$conn->query($sel_query);
$user_details=$execute->fetch_assoc();
var_dump($user_details);
if($user_details['event_name']=='admin')
{   session_start();
    $_SESSION['user']="super_user";
    //Location:/takshak/admin/admin.php
    header("Location:/admin/admin.php");
}
else if($user_details['event_name']==null){
    header("Location:invalid_credentials.php");
}
else{
    session_start();
    $_SESSION['user']="coordinator";
    $_SESSION['event_name']=$user_details['event_name'];
    header("Location:/takshak/admin/coordinator.php");
    echo($user_details['event_name']);
}



?>
