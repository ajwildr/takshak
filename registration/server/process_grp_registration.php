<?php
include('connect.php');
//$event_id=$_SESSION['event_id'];
session_start();
$event_id=$_SESSION['event_id'];
$select_strength="SELECT grp_strenght,event_name from event_details where event_id='$event_id'";
echo($select_strength);
$sel=$conn->query($select_strength);
$event_details=$sel->fetch_assoc();
echo("\nlimit\n");
var_dump($event_details);
echo("\n");
$limit=$event_details['grp_strenght'];
$event_name=$event_details['event_name'];
echo($limit);
$clg=$_POST['collegename'];
$dpt_name=$_POST['department'];
$t_name=$_POST['teamname'];
$t_cap=$_POST['teamcaptain'];
$mail=$_POST['email'];
$phn=$_POST['phone'];
$alt_phn=$_POST['altphone'];
$t_members="";
$trans_id=$_POST['transaction'];


for($i=2;$i<=$limit;$i++)
    {
      $name="member".$i;
      $temp_name=$_POST[$name];
      $t_members=$t_members.",".$temp_name;
    }
$insert_query="INSERT into group_event(clg_name,dept_name,team_name,captain_name,
mail,phone,alt_phone,team_members,event_name,event_id,transaction_id) 
values('$clg','$dpt_name','$t_name','$t_cap','$mail','$phn','$alt_phn','$t_members','$event_name','$event_id','$trans_id')";
echo($insert_query);
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
       // header("location:reg_failed.php");
        mysqli_close($conn);
        echo "<script>window.location.href = 'reg_failed.php';</script>";
        //echo($conn->error);
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>
