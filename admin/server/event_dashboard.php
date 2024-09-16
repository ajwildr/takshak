<?php
include('connect.php');
$event_limit_details="SELECT * from event_limit";
$data=$conn->query($event_limit_details);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            position: relative;
        }
        header button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
        header button:hover {
            background-color: #d32f2f;
        }
        h1 {
            margin: 20px 0;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<header>
    <button onclick="history.back()">Back</button>
    <h1>Event Dashboard</h1>
</header>

<table>
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Current Registrations</th>
            <th>Registration Limit</th>
        </tr>
    </thead>
    <tbody>
        <?php while($event_details=$data->fetch_assoc())
    {

?>
        <tr>
            <td><?php echo($event_details['event_id']) ?></td>
            <td><?php echo($event_details['event_name']) ?></td>
            <td><?php echo($event_details['current_reg']) ?></td>
            <td><?php echo($event_details['reg_limit']) ?></td>
        </tr>
       <?php
          }
?>
        <!-- Add more rows as needed -->
    </tbody>
</table>

</body>
</html>