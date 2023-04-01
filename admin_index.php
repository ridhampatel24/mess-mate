<?php

require 'database/include.php';

if(!isset($_SESSION['userno'])){
  header('location: login.php');
  exit();
}

?>

<?php 

//for approx users
$tdate = date('Y-m-d');
$approx_user = "SELECT COUNT(userid) as users FROM `token` WHERE status = 1 AND estime>= $tdate";
$approx_result = mysqli_query($conn, $approx_user);
if(mysqli_num_rows($approx_result) > 0){
$approx_row = mysqli_fetch_assoc($approx_result);
$approx_users = $approx_row['users'];
}else{
  $approx_users = 0;
}

$added_user = "SELECT added_user FROM `meal` WHERE date = '$tdate' and type = 1";
$added_result = mysqli_query($conn, $added_user);
if(mysqli_num_rows($added_result) > 0){
$added_row = mysqli_fetch_assoc($added_result);
$added_users = explode(',', $added_row['added_user']);
$added_usersl = count($added_users);
}else{
  $added_usersl = 0;
}
$added_user2 = "SELECT added_user FROM `meal` WHERE date = '$tdate' and type = 0";
$added_result2 = mysqli_query($conn, $added_user2);
if(mysqli_num_rows($added_result2) > 0){
$added_row2 = mysqli_fetch_assoc($added_result2);
$added_users2 = explode(',', $added_row2['added_user']);
$added_usersd = count($added_users2);
}else{
  $added_usersd = 0;
}

$lunch_app = $approx_users + $added_usersd;
$dinner_app = $approx_users + $added_usersl;



?>

<?php

//for lunch 

$tdate = date('Y-m-d');

$lunch_sql = "SELECT * FROM `meal` WHERE date = '$tdate' and type = 0";
$lunch_result = mysqli_query($conn, $lunch_sql);
$lunch_row = mysqli_fetch_assoc($lunch_result);

$lunch = 0;
if($lunch_row > 0){
  $lunch = 1;
  $lunch_items = explode('||', $lunch_row['items']);
  $lunch_price = $lunch_row['price'];
}


//for dinner

$dinner_sql = "SELECT * FROM `meal` WHERE date = '$tdate' and type = 1";
$dinner_result = mysqli_query($conn, $dinner_sql);
$dinner_row = mysqli_fetch_assoc($dinner_result);

$dinner = 0;
if($dinner_row > 0){
  $dinner = 1;
  $dinner_items = explode('||', $dinner_row['items']);
  $dinner_price =  $dinner_row['price'];
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
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/style2.css" rel="stylesheet">
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
          <li><a href="admin_feedback.php">FeedBack</a></li>
          <li><a href="#php">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

    
   
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
    <a class="log_btn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
  </header><!-- End Header -->

  <center>
    <h2 class="massage">Have a Look at Today's Menu</h2>
  </center>
  <div class="container">
  
  <div class="today-menu">
    <div>
      <!-- lunch  -->
     <?php 
     if($lunch){
      echo '
      <div class="lunch">
        <div class="menu-title">
          <h2>Lunch</h2>
        </div>
        <div class="menu-content">
          <div class="menu-text">
            ';
            foreach($lunch_items as $item){
              echo '<p>'.$item.'</p>';
            }
            echo '
          </div>
          <div class="menu-opstions">
          <form action ="delete_meal.php" method="POST">
          <input type="hidden" name="lunch_id" value="'.$lunch_row['id'].'">
          <button type="submit" name="delete_lunch">Delete</button>
          </form>
          ';
          echo '
          <p>'.$lunch_price .' &#8377;</p>
          </div>
          </div>
        </div>
      ';
     }else{
      echo '
      <div class="lunch">
      <div class="menu-title">
        <h2>Lunch</h2>
      </div>
      <div class="menu-content">
      <div class="menu-text">
      <p>Menu is not available yet!</p>
      </div>
        </div>
      </div>
      ';
      
     }
?>
    
         <!-- end lunch  -->

      <?php

      if($dinner){
        echo '
        <div class="dinner">
        <div class="menu-title">
          <h2>Dinner</h2>
        </div>
        <div class="menu-content">
          <div class="menu-text">
            ';
            foreach($dinner_items as $item){
              echo '<p>'.$item.'</p>';
            }
            echo '
          </div>
          <div class="menu-opstions">
          <form action ="delete_meal.php" method="POST">
          <input type="hidden" name="dinner_id" value="'.$dinner_row['id'].'">
          <button type="submit" name="delete_dinner">Delete</button>
          </form>';
          echo '
          <p>'.$dinner_price .' &#8377;</p>
          </div>
        </div>
      </div>
        ';
      }else{
        echo '
        <div class="dinner">
      <div class="menu-title">
        <h2>Dinner</h2>
      </div>
      <div class="menu-content">
      <div class="menu-text">
      <p>Menu is not available yet!</p>
      </div>
        </div>
      </div>
        ';
      }

      ?>

      <!-- end dinner  -->
    </div>

<div>
    <div class="poll">
      <?php 

        $tdate = date("Y-m-d");

        $sql = "SELECT * FROM `poll` WHERE `last_date` >= '$tdate'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($row){
        $que = $row['pol'];
        $options = explode("||||", $row['options']);
        $sql = "SELECT * FROM `poll`";
                 $result = $conn->query($sql);
                 
                 foreach($result as $row){
                  echo "
                  <div class='poll-title'>
                    ".$row['pol']."
                  </div>
                  <div class='poll-content'>
                  ";
                    $opt = explode("||||",$row['options']);
                    $votes = explode("||||",$row['votes']);
                    for($i = 0; $i<count($opt); $i++){
                        $votePercent = '0%';
                        if($votes[$i] && $row['total_votes']){
                            $votePercent = round(($votes[$i]/$row['total_votes'])*100);
                            $votePercent = !empty($votePercent) ? $votePercent.'%' : '0%';
                        }
                        echo "
                        <label>".$opt[$i]."</label>
                        <div class='progress'>
                            <div class='progress-bar' role='progressbar' style='width: ".$votePercent."' aria-valuenow='15' aria-valuemin='0' aria-valuemax='100'>".$votePercent."</div>
                            </div>
                        ";
                    }
                    echo "
                    </div>";
                }
            }
            else{
              echo "
              <div class='poll-title'>
                No Polls Available
              </div>
              <div class='poll-btn'>
              <center>
                   
                </center>
                </div>
              ";
            }
      
      ?>
      
    </div>
    
    <div class="prefrence">
      <div class="poll-title">
        Approximate User Coming 
      </div>
      <div class="poll-content">
        For Lunch : <?php echo $lunch_app; ?><br>
        
        For Dinner : <?php echo $dinner_app; ?><br>
      </div> 
    </div>
  </div>
  </div>
  </div>
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
              <strong>Lunch: 12PM</strong> - 2PM<br>
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

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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

</body>

</html>