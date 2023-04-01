<?php

require 'database/include.php';

if (!isset($_SESSION['userno'])) {
    header('location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mess Mate</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="assets/img" rel="icon"> -->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/style2.css" rel="stylesheet">
    <link href="assets/css/livemeal.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b4acf271a3.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
                <h1>Mess-Mate<span>.</span></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="admin_index.php">Home</a></li>
                    <li><a href="admin_profile.php">Profile</a></li>
                    <li><a href="report.php">Analysis Report</a></li>
                    <li><a href="#php">Contact</a></li>
                </ul>
            </nav><!-- .navbar -->



            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
        <a class="log_btn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header><!-- End Header -->

    <div class="title">
            <h2>Today</h2>
        </div>
    <div class="main" id="main">

    
    <!-- <div class="lm_container" id="lm_container">
        

        <div class="meal">
            <div class="img">
                <img src="assets/user.png" alt="" height="100px" width="100px">
            </div>
            <div class="content">
                <div class="name">
                    <p>John Doe</p>
                </div>
                <div class="date">
                    <p>Date : 23-04-2023</p>
                </div>
                <div class="type">
                    <p>Meal Type: Dinner</p>
                </div>
                <div class="price">
                    <p>Cost: Rs. 50</p>
                </div>
            </div>
        </div>
    </div> -->
</div>

<div class="txtHint" id="txtHint"></div>
    <!-- Vendor JS Files -->

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>
<script>
 
 setInterval(function(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("main").innerHTML = this.responseText;
      }
    };
    console.log("hello");
    xmlhttp.open("GET", "live_meal_data.php?", true);
    xmlhttp.send();}, 1000);

</script>
</html>