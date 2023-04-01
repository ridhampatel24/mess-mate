<?php

require 'database/include.php';

if ($_SESSION['user_type'] != 'admin') {
  header('location: login.php');
  exit();
}
if(!isset($_SESSION['item_id'])){
    header('location: inventory.php');
  exit();
}
else{
  $item_id = $_SESSION['item_id'] ;
 
    if(isset($_POST['add_item']) && isset($_POST['edit_q']) && 0< $_POST['edit_q']){
      $edit_q = $_POST['edit_q'];
      $sql = "UPDATE `inventory` SET `quntity`=`quntity`+$edit_q WHERE `item_id`='$item_id'";
      $result = mysqli_query($conn, $sql);

    }
    if(isset($_POST['remove_item']) && isset($_POST['edit_q']) && 0< $_POST['edit_q']){
      $edit_q = $_POST['edit_q'];
      $sql = "UPDATE `inventory` SET `quntity`=`quntity`-$edit_q WHERE `item_id`='$item_id'";
      $result = mysqli_query($conn, $sql);
        
    }
}


$mobile = $_SESSION['userno'];
$id = $_SESSION['id'];

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
  <link href="assets/css/inventory.css" rel="stylesheet">
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
          <li><a href="admin_index.php">Home</a></li>
          <li><a href="admin_profile.php">Profile</a></li>
          
          <li><a href="report.php">Analysis Report</a></li>
          <li><a href="inventory.php">Inventory</a></li>
          <li><a href="#php">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->


      <a class="btn-book-a-table" href="subscription.php" disabled>Buy Token</a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
    <a class="log_btn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
  </header><!-- End Header -->
  <section class="vh-200" style="background-color: #FFCC97;">
    <div class="container py-5 h-100">


    <?php 
    $item_id = $_SESSION['item_id'] ;

    $sql = "SELECT * FROM inventory WHERE `item_id`='$item_id'";    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $quntity = $row['quntity'];

    
    ?>
      <div class="card" style="border-radius: 15px;">
        <div class="card-body p-4">
          <div class="d-flex text-black">
            <div class="flex-shrink-0">
              <img src="assets/user.png" alt="Generic placeholder image" class="img-fluid" style="width: 180px; margin-top:60px; border-radius: 10px;">
            </div>
            <div class="flex-grow-1 ms-3">
              <h3 class="mb-1"><?php echo $name;?></h3>
              <h3 class="mb-1">Total quntity:  <?php echo $quntity;?>KG</h3>

              <div class="pro_detail">
               
              </div>

              <div class="d-flex pt-1 admin_btn">

              <form method="POST" class="btn_form">
                <div class="edit_item">
                <label>Quntity To edit: </label><input type="number" name="edit_q">
                </div>
                <div class="btn_form">
                <button type="submit" name="add_item" class="btn btn-outline-dark me-1 flex-grow-1" >Add</button>
              
                <button type="submit" name="remove_item" class="btn btn-outline-dark me-1 flex-grow-1" >Remove</button>
                </div>
                </form>
     
              </div>
              
              <div class="d-flex justify-content-start rounded-3 p-2 mb-2">
              </div>
              
            </div>

          </div>
        </div>
      </div>

    </div>

    </div>

  

  </section>

  <!-- End Hero -->


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

</html>