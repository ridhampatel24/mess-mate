<?php

require 'database/include.php';

if ($_SESSION['user_type'] != 'user') {
  header('location: login.php');
  exit();
}

$tdate = date('Y-m-d');
$mobile = $_SESSION['userno'];
$sql1 = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
$result1 = mysqli_query($conn, $sql1);
$row2 = mysqli_fetch_assoc($result1);
$uid = $row2['id'];

$sql = "SELECT * FROM `poll`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$users = explode(",", $row['users']);


$sqltoken = "SELECT * FROM `token` WHERE `mobno` = '$mobile' ";
$result = mysqli_query($conn, $sqltoken);
$row = mysqli_fetch_assoc($result);

$dont_go = 0;
if($row > 0){
$dont = $row['dontgo'];

if($dont == $tdate){
  $dont_go = 1;
  $scan = 0;
  $tkn = 0;
  $status = 1;
}else{
$token = $row['tokens'];
$status = $row['status'];
$tdate = date('Y-m-d');
$edate = $row['estime'];
if($token < 0 || $edate < $tdate){  
  $tkn = 1;
}else{
  $tkn = 0;
}
if($token > 0 && $status && $tdate <= $edate){
  $scan = 1;
}else{
  $scan = 0;
}
}
}else{
  $scan = 0;
  $tkn = 0;
  $status = 1;
}


//not coming today

$not_come = "SELECT * from `token` WHERE status = 1 and tokens>0 and `dontgo` != '$tdate' AND `mobno` = '$_SESSION[userno]' ";
$result_not_come = mysqli_query($conn, $not_come);
$row_not_come = mysqli_num_rows($result_not_come);
if($row_not_come == 0){
  $not_come = 0;
}else{
  $not_come = 1;
}

?>

<?php

if(isset($_POST['prefrence'])){
  
  $time = date('H');
  $tdate = date('Y-m-d');

  if($time >= 0 && $time < 12){
    $sql = "UPDATE `meal` SET `wastage_user`=`wastage_user`-1 WHERE `date` = '$tdate' AND `type` = '0' ";
    $result = mysqli_query($conn, $sql);
  }else{
    $sql = "UPDATE `meal` SET `wastage_user`=`wastage_user`-1 WHERE `date` = '$tdate' AND `type` = '1'";
    $result = mysqli_query($conn, $sql);
  }

  $sql1 = "UPDATE `token` SET `dontgo`='$tdate' WHERE `mobno` = '$mobile' ";
  $result1 = mysqli_query($conn, $sql1);

}

?>

<?php

if(isset($_POST['reserv'])){

  $id = $_POST['id'];

  $sql = "SELECT * FROM `meal` WHERE `id` = '$id  ' ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $added_users = $row['added_user'];
  $added_users = explode(",", $added_users);

  if($added_users[0] == NULL){
    $added_users = $_SESSION['id'];
  }else{
    $added_users = $added_users.",".$_SESSION['id'];
  }

  $sql = "UPDATE `meal` SET `added_user`= '$added_users'  WHERE `id` = '$id' ";
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

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

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
    <h2 class="massage">Have a Look at Today's Menu</h2>
  </center>
  <div class="container">
  
  <div class="today-menu">
    <div>

    <?php 
    $tdate = date('Y-m-d');
    $sqL = "SELECT * FROM `meal` WHERE `type` = '0' and `date` = '$tdate'";
    $result = mysqli_query($conn, $sqL);
    $row = mysqli_fetch_assoc($result);
    if($row != NULL){
      $items = explode('||', $row['items']);
      $users = explode(',', $row['users']);
      $added_users = explode(',', $row['added_user']);
      $present = 0;

      $added = 0;
      if(in_array($uid,$added_users)){
        $added = 1;
      }
      if(in_array($uid,$users)){
        $present = 1;
      }
      $price = $row['price'];
      $id = $row['id'];


      echo '
      <div class="lunch">
      <div class="menu-title">
        <h2>Lunch</h2>
      </div>
      <div class="menu-content">
      <div class="menu-text">
      ';
      foreach($items as $item){
        echo '<p>'.$item.'</p>';
      }
      echo '
      </div>';
      if($present == 0){
        echo '
          <div class="menu-opstions">
            ';
            if($added == 0){
            if($dont_go == 0){
            if($scan){
              echo '<button onclick="toscanner()" >scan</button>';
            }elseif($tkn){
              echo '<button>Reserve a plate</button>';
            }elseif($status == 0){
              echo '<button>Activate</button>';
            }else{
              echo '
              <form action="" method="post">
            <input type="hidden" name="id" value=" '.$id.'">
              <button type="submit" name="reserv">Reserve a plate</button>
              </form>';
            }
            echo '
            <p>'.$price .' &#8377;</p>';
            }
            else{
              echo  '<p>'.$price .' &#8377;</p>';
            }
          }else{
            echo '<button onclick="toscanner()" >scan</button>
            <p>'.$price .' &#8377;</p>';
          }
            echo'
          </div>
          ';
      }else{
        echo '
        <div class="menu-opstions">
         <button   disabled> scan </button>
         </div>
        ';
      }
      echo '
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
      <p>Menu will be availabe soon</p>
      </div>
        </div>
      </div>
      ';
    }

    ?>
      <!-- lunch  -->
      <!-- <div class="lunch">
        <div class="menu-title">
          <h2>Lunch</h2>
        </div>
        <div class="menu-content">
          <div class="menu-text">
            <p>Gobi Paratha</p>
            <p>Alu Sabji</p>
            <p>Jira Rice</p>
            <p>Dal Fry</p>
            <p>Gajar Halwa</p>
          </div>
          <div class="menu-opstions">
            <button>Reserve a plate</button>
            <p>50 RS.</p>
          </div>
        </div>
      </div> -->
     <!-- end lunch  -->

     <?php 
     $sqD = "SELECT * FROM `meal` WHERE `type` = '1' and `date` = '$tdate'";
      $result = mysqli_query($conn, $sqD);
      $row = mysqli_fetch_assoc($result);

      if($row != NULL){
        $items = explode('||', $row['items']);
      $users = explode(',', $row['users']);
      $added_users = explode(',', $row['added_user']);
      $present = 0;

      $added = 0;
      if(in_array($uid,$added_users)){
        $added = 1;
      }
      if(in_array($uid,$users)){
        $present = 1;
      }
      $price = $row['price'];
      $id = $row['id'];

      echo '
      <div class="dinner">
      <div class="menu-title">
        <h2>Dinner</h2>
      </div>
      <div class="menu-content">
      <div class="menu-text">
      ';
      foreach($items as $item){
        echo '<p>'.$item.'</p>';
      }
      echo '
      </div>';
      if($present == 0){
        echo '
          <div class="menu-opstions">
            ';
            if($added == 0){
            if($dont_go == 0){
            if($scan){
              echo '<button onclick="toscanner()" >scan</button>';
            }elseif($tkn){
              echo '<button>Reserve a plate</button>';
            }elseif($status == 0){
              echo '<button>Activate</button>';
            }else{
              echo '
              <form action="" method="post">
            <input type="hidden" name="id" value=" '.$id.'">
              <button type="submit" name="reserv">Reserve a plate</button>
              </form>';
            }
            echo '
            <p>'.$price .' &#8377;</p>';
            }
            else{
              echo  '<p>'.$price .' &#8377;</p>';
            }
          }else{
            echo '<button onclick="toscanner()" >scan</button>
            <p>'.$price .' &#8377;</p>';
          }
            echo'
          </div>
          ';
      }else{
        echo '
        <div class="menu-opstions">
         <button   disabled> scan </button>
         </div>
        ';
      }
      echo '
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
      <p>Menu will be availabe soon</p>
      </div>
        </div>
      </div>
      ';
    }
     ?>
      <!-- dinner  -->
      <!-- <div class="dinner">
        <div class="menu-title">
          <h2>Dinner</h2>
        </div>
        <div class="menu-content">
          <div class="menu-text">
            <p>Gobi Paratha</p>
            <p>Alu Sabji</p>
            <p>Jira Rice</p>
            <p>Dal Fry</p>
            <p>Gajar Halwa</p>
          </div>
          <div class="menu-opstions">
            <button>Reserve a plate</button>
            <p>50 RS.</p>
          </div>
        </div>
      </div> -->

      <!-- end dinner  -->
    </div>

<div>
    <div class="poll">
      <?php 
      $tdate = date("Y-m-d");

      $sql = "SELECT * FROM `poll` where `last_date` >= '$tdate' ";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      
      if($row > 0){
      $users = explode(',', $row['users']);


      if(in_array($uid, $users)){
        $sql = "SELECT * FROM `poll` where `last_date` >= '$tdate'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
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
      } else{
        echo "<form action='poll.php' method='POST'>";
        $sql = "SELECT * FROM `poll` where `last_date` >= '$tdate'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $que = $row['pol'];
        $options = explode("||||", $row['options']);

        echo '<div class="poll-title">
          '.$que.'
        </div> 
        <div class="poll-content">';
        for($i=0; $i<sizeof($options); $i++){
          echo '<input type="radio" name="poll" id="'.$i.'" required value="'.$i.'">  <label for="'.$i.'">'.$options[$i].'</label><br>
          ';
        }
        echo '</div>
        <input type="hidden" name="pollid" value="'.$row['id'].'">
        <center><button name="pollbtn">Submit</button></center>';
        echo "</form> ";
      }
    }else{
      echo "
      <div class='poll-title'>
        No Poll Available
      </div>
      ";
    }
      ?>
     
      <!-- <div class="poll-title">
        Tomorrow's Meal Suggestion?
      </div>
      <div class="poll-content">
        <input type="checkbox"> <label>Alu Sabji</label><br>
        <input type="checkbox"> <label>Matar panir</label><br>
        <input type="checkbox"> <label>Sahi panir</label><br>
        <input type="checkbox"> <label>Alu matar</label><br>
      </div>
      <center><button>Submit</button></center> -->
    </div>
    
    <div class="prefrence">
      <div class="poll-title">
        Not Comming Today.
      </div>
      <?php
      if($not_come == 0){
        echo '
        <div class="poll-content">
          SEE YOU TOMORROW
      </div>
        ';

      }else{
        echo '
        <div class="poll-content">
        I will not Eating Todays meal.
      </div>
      <center>
        <form action="" method="POST">
          <input type="hidden" name="prefrence" value="1">
          <button name="prefrencebtn">Submit</button>
        </form>
      </center>
        ';
      }
      ?>
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
<script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
<script>
  function toscanner(){
    window.location.href = "scaner.php";
  }
  </script>
</html>