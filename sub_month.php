<?php

require 'database/include.php';

if (!isset($_SESSION['userno'])) {
  header('location: login.php');
  exit();
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay_btn'])){

  $_SESSION["t_meal"]= $_POST['t_meal'];
  $_SESSION["t_price"]= $_POST['t_price'];
  $_SESSION["s_date"]= $_POST['s_date'];
  $_SESSION["e_date"]= $_POST['e-date'];
  $_SESSION["ex_date"]= $_POST['ex_date'];
  $_SESSION["type_meal"]= $_POST['sub-type'];
 

  if($_POST['t_meal'] >=20 && $_POST['t_meal'] <= 49){
    $_SESSION["discont"]= $_POST['t_price'] * 0.05;
  }
  else if($_POST['t_meal'] >=50 && $_POST['t_meal'] <= 79){
    $_SESSION["discont"]= $_POST['t_price'] * 0.10;
  }
  else if($_POST['t_meal'] >=80){
    $_SESSION["discont"]= $_POST['t_price'] * 0.15;
  }
  else{
    $_SESSION["discont"]= 0;
  }

  $_SESSION['invoice_id'] =  "TS".rand(10000000,99999999);
  echo "
    <script>
    window.location.href = 'payment.php';
    </script>";
  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subscription</title>
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/b4acf271a3.js" crossorigin="anonymous"></script>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/style2.css" rel="stylesheet">
</head>

<body>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Mess-Mate<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#php">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

    
      <a class="btn-book-a-table" href="subscription.php">Buy Token</a>
   
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
    <a class="log_btn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
  </header><!-- End Header -->
  <center>
    <h2 class="massage">Subscription</h2>
  </center>
  <div class="container">

    <div class="subscripstion">

      <form method="POST">
        <div class="sub-btn">
          <a href="subscription.php"><button class="sub-butn" type="button">Costom</button></a>
          <a href="sub_weak.php"><button class="sub-butn" type="button">Weakly</button></a>
          <a href=""><button class="sub-butn" type="button">Monthly</button></a>

        </div>

        <div class="contex">
          <div class="sub-content">
            <label>User Id</label><br>
            <input type="text"  disabled value="<?php echo $_SESSION['user_email'];?>"><br>

            <label>Number Of Month</label><br><input type="number" onchange="meal_count()" id="no_month" placeholder="0" max="2" min="1"><br>

            <label id="s_date_l">Start Date</label><label id="e_date_l">End Date</label><br>
            <input id="s_date" name="s_date" type="date"><input id="e_date" type="date" disabled><br>


            <div class="sub-type">
              <label>Meal Type</label><br>
              <input type="radio" name="sub-type" id="lunch" value="1" onclick="meal_count()"><label>Lunch</label>
              <input type="radio" name="sub-type" id="dinner" value="2" onclick="meal_count()"><label>Dinner</label>
              <input type="radio" name="sub-type" id="lun-din" value="3" onclick="meal_count()"><label>Lunch & Dinner</label><br>
            </div>
            <label id="t-meal-l">Total Meal</label><label id="ex-date-l">Expire Date</label><br>
            <input id="t-meal" type="text" disabled>
            <input id="ex-date" value="9999-12-31" disabled><br>
            <input type="hidden" name="t_price" id="t_price">
            <input id="t_meal" name="t_meal" type="hidden">
            <input id="ex_date" name="ex_date" type="hidden">
            <input id="e-date" name="e-date" type="hidden">

            <center><button name="pay_btn" id="pay_btn">Pay 0 Rs</button></center>
          </div>

          <div class="image_div">
            <img src="assets/dinner.png" alt="">
          </div>

        </div>
      </form>
    </div>


  </div>

</body>

<script>
  var sub_btn = document.getElementsByClassName("sub-butn");
  sub_btn[2].style.backgroundColor = "#FFCC97";

  function meal_count() {
    end_date();
    var s_date = new Date(document.getElementById("s_date").value);
    var e_date = new Date(document.getElementById("e_date").value);
    var r_lunch = document.getElementById("lunch");
    var r_dinner = document.getElementById("dinner");
    var r_lun_din = document.getElementById("lun-din");


    var diff = e_date.getTime() - s_date.getTime();
    var ex_date = new Date(e_date.getTime() + (1000 * 60 * 60 * 24 * 60));
    let year = ex_date.getFullYear();
    let month = ex_date.getMonth() + 1;
    let day = ex_date.getDate();

    if (month < 10) {
      month = "0" + month;
    }
    if (day < 10) {
      day = "0" + day;
    }
    ex_date = year + "-" + month + "-" + day;
    console.log(ex_date);
    document.getElementById("ex-date").value = ex_date;
    document.getElementById("ex_date").value = ex_date;

    var daydiff = diff / (1000 * 60 * 60 * 24);
    if (r_lunch.checked || r_dinner.checked) {
      daydiff = daydiff + 1;
    } else if (r_lun_din.checked) {
      daydiff = (daydiff + 1) * 2
    }
    document.getElementById("t-meal").value = daydiff;
    document.getElementById("t_meal").value = daydiff;
    document.getElementById("t_price").value = daydiff * 50;
    document.getElementById("pay_btn").innerHTML = "Pay "+daydiff*50+"Rs";
  }

  function end_date() {
    var s_date = new Date(document.getElementById("s_date").value);
    var no_month = document.getElementById("no_month").value;

    var e_date = new Date(s_date.getTime() + (1000 * 60 * 60 * 24 * 30 * no_month));
    let year = e_date.getFullYear();
    let month = e_date.getMonth() + 1;
    let day = e_date.getDate();

    if (month < 10) {
      month = "0" + month;
    }
    if (day < 10) {
      day = "0" + day;
    }
    e_date = year + "-" + month + "-" + day;
    document.getElementById("e_date").value = e_date;
    document.getElementById("e-date").value = e_date;
  }

</script>
<script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>