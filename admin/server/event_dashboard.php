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
            text-align: left;
        }
        header button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        header button:hover {
            background-color: #d32f2f;
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
</header>

<h1>Event Dashboard</h1>

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
        <tr>
            <td>1</td>
            <td>Hackathon 2024</td>
            <td>50</td>
            <td>100</td>
        </tr>
        <tr>
            <td>2</td>
            <td>AI Workshop</td>
            <td>75</td>
            <td>80</td>
        </tr>
        <!-- Add more rows as needed -->
    </tbody>
</table>

</body>
</html>
