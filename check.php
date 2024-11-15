<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MCA Takshak</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: rgb(4, 139, 76);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }

        input[type="email"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 2px solid rgb(4, 139, 76);
            background-color: #333;
            color: white;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #ff6666;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #333;
        }

        table, th, td {
            border: 2px solid rgb(4, 139, 76);
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: rgb(4, 139, 76);
            color: black;
        }

        td {
            color: white;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 24px;
            }

            label, input, th, td {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-3">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="img/logo.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="#">Check Status</a></li>
                                            <li><a href="admin/login_page.php">Login</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="buy_tkt">
                                    <div class="book_btn d-none d-lg-block">
                                        <a href="events.html">Register Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="slider_area">
        <div class="single_slider d-flex align-items-center slider_bg_1 overlay">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <h1>Registration Status</h1>

                            <div class="container">
                                <form method="POST" action="event_status.php" >
                                    <input type="email" id="email" name="mail" placeholder="Enter your registered email ID" required>
                                    <input  type="submit" value="Check Status" name="check">
                                </form>

                                <?php
                                if (isset($_POST['check'])) {
                                    echo("hai");
                                    include('/registration/server/connect.php');
                                    $mail = $_POST['mail'];

                                    $sel_grp = "SELECT * FROM group_event WHERE mail='$mail'";
                                    $grp_data = $conn->query($sel_grp);

                                    $sel_ind = "SELECT * FROM individual_events WHERE mail='$mail'";
                                    $ind_data = $conn->query($sel_ind);
                                ?>

                                <h1>Individual Events</h1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Email ID</th>
                                            <th>Name</th>
                                            <th>Event Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($ind_event = $ind_data->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $ind_event['mail']; ?></td>
                                            <td><?php echo $ind_event['name']; ?></td>
                                            <td><?php echo $ind_event['event_name']; ?></td>
                                            <td><?php echo $ind_event['status']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <h1>Group Events</h1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Email ID</th>
                                            <th>Captain Name</th>
                                            <th>Event Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($grp_event = $grp_data->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $grp_event['mail']; ?></td>
                                            <td><?php echo $grp_event['captain_name']; ?></td>
                                            <td><?php echo $grp_event['event_name']; ?></td>
                                            <td><?php echo $grp_event['status']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php sleep(3);} ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
