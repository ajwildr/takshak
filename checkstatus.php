<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MCA Takshak</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/slicknav.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

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

        input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 5px;
            border: 2px solid rgb(4, 139, 76);
            background-color: #333;
            color: white;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: rgb(4, 139, 76);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
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

        /* Media query for smaller screens */
        @media (max-width: 600px) {
            h1 {
                font-size: 24px;
            }

            label {
                font-size: 16px;
            }

            input[type="email"] {
                font-size: 14px;
            }

            input[type="submit"] {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
                font-size: 14px;
            }

            .container {
                padding: 15px;
            }

            /* Table styling for small screens */
            table, th, td {
                font-size: 12px;
                padding: 5px;
            }
        }
    </style>
</head>
<body>

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-3">
                                <div class="logo">
                                    <a href="index.html"></a>
                                        <img src="img/logo.png" alt="">
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
                                            <li><a href="admin\login_page.php">Login</a></li>
                                            
                                            <!--<li><a href="#">pages <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="about.html">about</a></li>
                                                    <li><a href="Program.html">Program</a></li>
                                                    <li><a href="Venue.html">Venue</a></li>
                                                    <li><a href="elements.html">elements</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">blog</a></li>
                                                    <li><a href="single-blog.html">single-blog</a></li>
                                                </ul>
                                            </li>-->
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
    <!-- header-end -->

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12">
                        <div class="slider_text text-center">
                            <div class="shape_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                                <img src="img/shape/shape_1.svg" alt="">
                            </div>
                                <h1>Registration Status</h1>
        
                                <div class="container">
                                    <form action="post">
                                        <input type="email" id="email" name="email" placeholder="enter your registered email id" requirgb(4, 139, 76)>
                                        <input type="button" value="Check Status" name="check"><br><br>
                                        </form>
                                    <?php
                                        
                                       if(isset($_POST['check']))
                                    {  
                                       
                                        include('/registration/server/connect.php');
                                        $mail=$_POST['mail']
                                        $sel_grp="select *  from group_event where mail='$mail'";
                                        $grp_data=$conn->query($sel_grp);
                                        $sel_ind="select * from individual_events where mail='$mail' ";
                                        $ind_data=$conn->query($sel_ind);
                                    ?>  <h1>Individual Events</h1>
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
                                                <?php
                                                while($ind_event=$ind_data->fetch_assoc())
                                                 {
                                                  ?>
                                                <tr>
                                                    <td><?php echo($ind_event['mail']) ?></td>
                                                    <td><?//php echo($ind_event['name']) ?></td>
                                                    <td><?php echo($ind_event['event_name']) ?></td>
                                                    <td><?php echo($ind_event['event_status']) ?></td>
                                                </tr>
                                                <?php
                                                 }
                                                  ?>
                                            </tbody>
                                        </table>
                                        <br><br>

                                        <h1>Group Events</h1>

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
                                                <?php
                                                  while($grp_event=$grp_data->fetch_assoc())
                                                    {
                                                ?>
                                                <tr>
                                                    <td><?php echo($grp_event['mail']) ?></td>
                                                    <td><?php echo($grp_event['captain_name']) ?></td>
                                                    <td><?php echo($grp_event['event_name']) ?></td>
                                                    <td><?php echo($grp_event['status']) ?></td>
                                                </tr>
                                              <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>

                            <div class="shape_2 wow fadeInDown" data-wow-duration="1s" data-wow-delay=".2s">
                                <img src="img/shape/shape_2.svg" alt="">
                            </div>
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->
</body>
</html>
