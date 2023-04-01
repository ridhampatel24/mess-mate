<?php

require 'database/include.php';

if (!isset($_SESSION['userno'])) {
    header('location: login.php');
    exit();
}

if ($_SESSION['user_type'] != 'admin') {
    header('location: login.php');
    exit();
}

if (isset($_POST['item_id'])) {

    $_SESSION['item_id'] = $_POST['item_id'];
    echo "<script>window.location.href = 'edit_item.php';
    </script>";
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
    <link href="assets/css/inventory.css" rel="stylesheet">
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
                    <li><a href="Inventory.php">Inventory Manage</a></li>
          <li><a href="admin_feedback.php">Feedback Report</a></li>
                </ul>
            </nav><!-- .navbar -->



            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
        <a class="log_btn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header><!-- End Header -->

    <div class="title">
        <h2>Item List</h2>
    </div>
    <div class="main" id="main">
        <?php
        $sql = "SELECT * FROM inventory";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['item_id'];
            $name = $row['name'];
            $image = "assets/" . $row['name'] . ".jpg";
            $quntity = $row['quntity'];

        ?>
            <form method="POST" name="item_form" id="item_form" class="item_form">
                <div class="add_btn" onclick="submitform()">
                    <div class="i_container" id="i_container">
                        <div class="item">
                            <div class="img">
                                <img src="<?php echo $image; ?>" alt="" height="100px" width="100px">
                            </div>
                            <div class="content">
                                <div class="name">
                                    <p><?php echo $name; ?></p>
                                </div>
                                <div class="quntity">
                                    <p>Quntity: <?php echo $quntity; ?> KG</p>
                                </div>

                                <input type="hidden" name="item_id" value="<?php echo $id; ?>">

                            </div>
                        </div>
                    </div>
                </div>
            </form>

        <?php } ?>
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
    function submitform() {
        console.log("hello");
        document.getElementById("item_form").submit();
    }
</script>

</html>