<?php
session_start();
$event_id=$_SESSION['event_id'];
include('connect.php');
//$event_id=$_SESSION['event_id'];

$select_strength="SELECT event_name from event_details where event_id='$event_id' ";
//echo($select_strength);
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
        $update_limit="UPDATE event_limit set current_reg=current_reg+1 where event_id='$event_id'";
        if($conn->query($update_limit))
             {
                  //header("Location:reg_sucess.php");
                 mysqli_close($conn);
                 echo "<script>window.location.href = 'reg_sucess.php';</script>";
              }
        else{   
                mysqli_close($conn);
               echo "<script>window.location.href = 'reg_sucess.php';</script>";
              //header("location:reg_success.php");
             }
    } else {
        mysqli_close($conn);
        echo "<script>window.location.href = 'reg_failed.php';</script>";
        //header("location:red_failed.php");
        // header("location:Failed.php");
        // echo($conn->error);
    }
}  catch (Throwable $e) {
    echo "<script>window.location.href = 'reg_failed.php';</script>";
    //echo "Query failed: " . $e->getMessage();
}
?>
