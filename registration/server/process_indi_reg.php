<?php
include('connect.php');
//$event_id=$_SESSION['event_id'];
session_start();
$event_id=$_SESSION['event_id'];
$select_strength="SELECT event_name from event_details where event_id=$event_id";
echo($select_strength);
$sel=$conn->query($select_strength);
$event_details=$sel->fetch_assoc();
$event_name=$event_details['event_name'];
//taking values from form
$clg=$_POST['collegename'];
$dpt_name=$_POST['department'];
$mail=$_POST['email'];
$phn=$_POST['phone'];
$trans_id=$_POST['transaction'];
$insert_query="INSERT into individual_events(clg_name,dept_name,mail,phone,transaction_id,event_name,event_id) values('$clg','$dpt_name','$mail','$phn','$trans_id','$event_name','$event_id')";
try {
    // Execute the query
    if ($conn->query($insert_query) === TRUE) {
        header("Location:reg_sucess.php");
        //header("location:reg_success.php");
    } else {
        header("location:red_failed.php");
        // header("location:Failed.php");
        // echo($conn->error);
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>
