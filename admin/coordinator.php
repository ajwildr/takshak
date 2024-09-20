<?php
session_start();
header("Content-Security-Policy: script-src 'none';");
if(isset($_SESSION['user']) && $_SESSION['user'] === "coordinator")
{
$event_name=$_SESSION['event_name'];
include('server/connect.php');
//$sel_grp_events="SELECT * from group_event order by time where event_name='$event_name'";
$sel_grp_events="SELECT * FROM group_event WHERE event_name='$event_name' AND status != 'deleted' ORDER BY time";
$sel_ind_events="SELECT * from individual_events where event_name='$event_name' AND status != 'deleted' ORDER BY time";
//pre record of grp events data object
$pre_grp_events=$conn->query($sel_grp_events);
//pre record of individual events data object
$pre_ind_events=$conn->query($sel_ind_events);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            padding: 15px;
            text-align: center;
        }

        header button {
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        header button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        h1, h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-size: 16px;
        }

        td {
            font-size: 14px;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-verify {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        .btn-verify:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .btn-reject {
            background-color: #f44336; /* Red */
            color: white;
        }

        .btn-reject:hover {
            background-color: #e53935;
            transform: scale(1.05);
        }
        .btn-pending {
            background-color: orange; /* Red */
            color: white;
        }

        .btn-pending:hover {
            background-color: darkorange;
            transform: scale(1.05);
        }

        
    </style>
</head>
<body>

    <!-- Header with Buttons -->
    <header>
        <button onclick="location.href='server/verified_users.php'">Verified Registrations</button>
        <button onclick="location.href='server/parti_dashboard.php'">Registrations Limit</button>
        <button onclick="location.href='server/delete_participant.php'">Delete Registrations</button>
        <button onclick="location.href='/index.html'">Logout</button>
    </header>

    <!-- Group Events Section -->
    <h1>Coordinator Dashboard</h1>
    <h2>Group Events</h2>
    <table>
        <tr>
            <th>College Name</th>
            <th>Department Name</th>
            <th>Team Name</th>
            <th>Captain Name</th>
            <th>Team Members</th>
            <th>Phone Number</th>
            <th>Email id</th>
            <th>Alternate Phone Number</th>
            <th>Event Name</th>
            <th>Transaction ID</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <!-- Example Row -->
         <?php while($grp_events=$pre_grp_events->fetch_assoc())
           {
         ?>
        <tr>
            <td><?php echo($grp_events['clg_name'])?></td>
            <td><?php echo($grp_events['dept_name'])?></td>
            <td><?php echo($grp_events['team_name'])?></td>
            <td><?php echo($grp_events['captain_name'])?></td>
            <td><?php echo($grp_events['team_members'])?></td>
            <td><?php echo($grp_events['phone'])?></td>
            <td><?php echo($grp_events['mail'])?></td>
            <td><?php echo($grp_events['alt_phone'])?></td>
            <td><?php echo($grp_events['event_name'])?></td>
            <td><?php echo($grp_events['transaction_id'])?></td>
            <td><?php echo($grp_events['status'])?></td>
            <td>
                <?php
                   if($grp_events['status']=='pending')
                   {
                ?>
                <a href="server/grp_event_verify.php?id=<?php echo $grp_events['reg_id'];?>" style="text-decoration: none;">
                <button class="btn btn-verify">Verify</button></a>
                <?php }
                    else{
                ?>
                <a href="server/grp_event_to_pending.php?id=<?php echo $grp_events['reg_id'];?>" style="text-decoration: none;">
                <button class="btn btn-pending">To Pending</button> </a>
                <?php
                    }
                ?>
                <a href="server/grp_event_reject.php?id=<?php echo $grp_events['reg_id'];?>" style="text-decoration: none;">
                <button class="btn btn-reject">Reject</button>
                </a>
            </td>
        </tr>
        <?php
           }
        ?>

        <!-- More rows can be added dynamically using PHP/JS -->
    </table>

    <!-- Individual Events Section -->
    <h2>Individual Events</h2>
    <table>
        <tr>
             <th>Name</th>
            <th>College Name</th>
            <th>Department Name</th>
            <th>Mail</th>
            <th>Phone Number</th>
            <th>Transaction ID</th>
            <th>Event Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
           while($ind_events=$pre_ind_events->fetch_assoc())
           {
        ?>
        <tr>
            <td><?php echo($ind_events['name']) ?></td>
            <td><?php echo($ind_events['clg_name']) ?></td>
            <td><?php echo($ind_events['dept_name']) ?></td>
            <td><?php echo($ind_events['mail']) ?></td>
            <td><?php echo($ind_events['phone']) ?></td>
            <td><?php echo($ind_events['transaction_id']) ?></td>
            <td><?php echo($ind_events['event_name']) ?></td>
            <td><?php echo($ind_events['status']) ?></td>
            <td>
                <?php
                  if($ind_events['status']=='pending')
                  {

                ?>
                <a href="server/ind_event_verify.php?id=<?php echo $ind_events['reg_id'];?>" style="text-decoration: none;">
                  <button class="btn btn-verify">Verify</button> 
                  </a>
                <?php
                  }
                else
                  {
                ?>
                    <a href="server/ind_event_to_pending.php?id=<?php echo $ind_events['reg_id'];?>" style="text-decoration: none;">
                   <button class="btn btn-pending">To Pending</button></a>
             <?php }?>
             <a href="server/ind_event_reject.php?id=<?php echo $ind_events['reg_id'];?>" style="text-decoration: none;">
                <button class="btn btn-reject">Reject</button></a>
            </td>
        </tr>
    <?php
           }
    ?>
        <!-- Add more rows as needed -->

</table>

</body>
</html>

<?php
}
else{
    header("Location:server/restricted.php");
}
?>
