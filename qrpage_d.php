<?php

require 'database/include.php';

if ($_SESSION['user_type'] != 'admin') {
  header('location: login.php');
  exit();
}

$mobile = $_SESSION['userno'];
$id = $_SESSION['id'];
$sql1 = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";

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
  <script type="text/javascript" src="assets/js/qrcode.js"></script>

  <script>
        function printDiv() {
            var divContents = document.getElementById("qrResult").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body ><center> <h1> QR for Dinner  </center> <br> <center> ');
            a.document.write(divContents);
            a.document.write('</center></body></html>');
            a.document.close();
            a.print();
        }
    </script>
</head>

<body>
  <!-- ======= Header ======= -->
  
  <section class="vh-200" style="background-color: #FFCC97;">
  <center>
  <button onclick="printDiv()" class="btn btn-light">Print this page</button>
  </center>
    <div class="container py-5 h-100">


    <?php 
    $tdate = date('Y-m-d');

    $sql = "SELECT * FROM meal WHERE `meal`.`date` = '$tdate' AND `meal`.`type` = '1'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
      $row = mysqli_fetch_assoc($result);
      $message = $row['id']. "^" . $tdate;
    }
    

    
    ?>
      <div class="card" style="border-radius: 15px;">
        <div class="card-body p-4">
          
          <div class="d-flex text-black"> 
            <div class="flex-grow-1 ms-3">
              <center><div id="qrResult" style="height:500px; width:500px"></div></center>
            </div>
          </div>
          
        </div>
      </div>

    </div>

    </div>

  

  </section>


  <script type="text/javascript">
    var qrcode= new QRCode(document.getElementById('qrResult'),{
    width:500,
    height:500
    });

    function generate(){
      var message = "<?php echo $message ?>";
      qrcode.makeCode(message);
    }
  </script>

    <script>generate()</script>

  <!-- End Hero -->

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
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>