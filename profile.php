
<?php

require 'database/include.php';

if (!isset($_SESSION['userno'])) {
  header('location: login.php');
  exit();
}

$mobile = $_SESSION['userno'];
$id = $_SESSION['id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['m_status']) && !empty($_POST) ) {
  $meal_status = $_POST['m_status'];
  if($meal_status == 'true')
    $meal_status = 1;
  else
    $meal_status = 0;
    
  $sql = "UPDATE `token` SET `status` = '$meal_status' WHERE `userid` = '$id'";
  $result = mysqli_query($conn, $sql);

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
  <link href="assets/css/profile.css" rel="stylesheet">
  <script type="text/javascript" src="assets/js/qrcode.js"></script>
  <script src="https://kit.fontawesome.com/b4acf271a3.js" crossorigin="anonymous"></script>


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

  <!--Division for Modal-->
<div id="myModal" class="modal fade" role="dialog">

<!--Modal-->
<div class="modal-dialog">

  <!--Modal Content-->
  <form action="feedback.php" method="post">
  <div class="modal-content">

    <!-- Modal Header-->
    <div class="modal-header">
      <h3>Feedback Request</h3>

      <!--Close/Cross Button-->
      <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
    </div>

    <!-- Modal Body-->
    <div class="modal-body text-center">
      <i class="far fa-file-alt fa-4x mb-3 animated rotateIn icon1"></i>
      <h3>Your opinion matters</h3>
      <h5>Help us improve our product? <strong>Give us your feedback.</strong></h5>
      <hr>
      <h6>Your Rating</h6>
    </div>

    <!-- Radio Buttons for Rating-->
    
    <div class="form-check mb-4">
      <input name="feedback" value="5" type="radio">
      <label class="ml-3">Very good</label>
    </div>
    <div class="form-check mb-4">
      <input name="feedback" value="4" type="radio">
      <label class="ml-3">Good</label>
    </div>
    <div class="form-check mb-4">
      <input name="feedback"  value="3" type="radio">
      <label class="ml-3">Mediocre</label>
    </div>
    <div class="form-check mb-4">
      <input name="feedback"  value="2" type="radio">
      <label class="ml-3">Bad</label>
    </div>
    <div class="form-check mb-4">
      <input name="feedback"  value="1" type="radio">
      <label class="ml-3">Very Bad</label>
    </div>

    <!--Text Message-->
    <div class="text-center">
      <h4>What could we improve?</h4>
    </div>
    <textarea type="textarea" name="message" placeholder="Your Message" rows="3"></textarea>


    <!-- Modal Footer-->
    <div class="modal-footer">
    <button type="submit" class="btn btn-success">Success</button>
      <a href="" class="btn btn-outline-primary" data-dismiss="modal">Cancel</a>
    </div>

    
  </div>
  </form>
</div>
</div>
  <section class="vh-200" style="background-color: #FFCC97;">
    <div class="container py-5 h-100">


      <?php

      $sql = "SELECT *
    FROM users
    INNER JOIN token ON token.userid=users.id WHERE users.id=$id";

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      $name = $row['name'];
      $email = $row['email'];
      $mobile = $row['mobile'];
      $tokens = $row['tokens'];
      $ex_day = (strtotime($row['estime']) - strtotime(date('d-m-Y'))) / (60 * 60 * 24);
      $e_date = date('d-m-Y', strtotime($row['end_time']));



      ?>
      <div class="card" style="border-radius: 15px;">
        <div class="card-body p-4">
          <div class="d-flex text-black">
            <div class="flex-shrink-0">
              <img src="assets/user.png" alt="Generic placeholder image" class="img-fluid" style="width: 180px; margin-top:60px; border-radius: 10px;">
            </div>
            <div class="flex-grow-1 ms-3">
              <h5 class="mb-1"><?php echo $name; ?></h5>
              <p class="mb-2 pb-1" style="color: #2b2a2a;"><?php echo $email; ?></p>

              <div class="pro_detail">
                <div class="pro_num">
                  <div>
                    <p class="small text-muted mb-1" style="color: #2b2a2a;">Mobile No.</p>
                    <p class="mb-0">+91 <?php echo $mobile; ?></p>
                  </div>
                </div>

                <div class="pro_token">
                  <div>
                    <p class="small text-muted mb-1" style="color: #2b2a2a;">Tokens</p>
                    <p class="mb-0"><?php echo $tokens; ?></p>
                  </div>
                </div>

                <div class="pro_token">
                  <div>
                    <p class="small text-muted mb-1" style="color: #2b2a2a;">Expired</p>
                    <p class="mb-0"><?php echo $ex_day; ?> Days left</p>
                  </div>
                </div>

                <div class="pro_token">
                  <div>
                    <p class="small text-muted mb-1" style="color: #2b2a2a;">Token End date</p>
                    <p class="mb-0"><?php echo $e_date; ?></p>
                  </div>
                </div>
              </div>

              <div class="d-flex pt-1">
                <?php
                if ($tokens <= 0) {
                  echo '<button type="button" class="btn btn-outline-dark me-1 flex-grow-1" onclick="to_tokens()">Buy Tokens</button>';
                } else {
                  echo '<button type="button" class="btn btn-outline-dark me-1 flex-grow-1" onclick="to_scaner()">Scan QR code</button>';
                }

                ?>
                <button type="button" class="btn btn-outline-dark me-1 flex-grow-1" onclick="to_payment()">Payment History</button>
              </div>

              <div class="d-flex justify-content-start rounded-3 p-2 mb-2">
                <center>
                  <form id="meal_status_form" method="POST">
                    <?php
                    $sql = "SELECT * FROM `token` WHERE `userid`= '$id';";
                    $result4 = mysqli_query($conn, $sql);
                    $row4 = mysqli_fetch_assoc($result4);
                    if ($row4['status'] == '1') {
                        
                     echo '<label class="switch">
                     <input type="checkbox" id="meal_status" checked name="meal_status" onclick="status()">
                    
                     <span class="slider round"></span>
                   </label>';
                    
                    } else {
                      echo '<label class="switch">
                      <input type="checkbox" id="meal_status" name="meal_status" onclick="status()">
                     
                      <span class="slider round"></span>
                    </label>';

                    }
                    ?>
                    
                    <input type="hidden" id="m_status" name="m_status">
                  </form>

                  <p class="mb-2"> Auto Plate Book</p>
                </center>
                <div class="d-flex pt-1" style="padding-left: 20px">
                    <button type="button" data-toggle="modal" data-target="#myModal"  class="btn btn-outline-dark me-1 flex-grow-1" >Give Feedback</button>
                </div>
              </div>
              

            </div>

          </div>
        </div>
      </div>

    </div>

    </div>



  </section>

  <!-- End Hero -->



  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Address</h4>
            <p>
              VGEC Hostel<br>
              Chandkheda, Ahemdabad 382424 <br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Reservations</h4>
            <p>
              <strong>Phone:</strong> +91 9999 898 668<br>
              <strong>Email:</strong> info@VGECHostel.com<br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Lunch: 12AM</strong> - 2PM<br>
              <strong>Dinner: 7PM</strong> - 10PM<br>

            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Mess-mate</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">CodeAvengers</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>
<script>

  function status() {
    var m_status = document.getElementById("meal_status").checked;
   console.log(m_status);
   document.getElementById("m_status").value = m_status;
   document.getElementById("meal_status_form").submit();

  }


  function to_scaner() {
    window.location.href = "scaner.php";
  }

  function to_tokens() {
    window.location.href = "subscription.php";
  }

  function to_payment() {

  }
</script>

</html>