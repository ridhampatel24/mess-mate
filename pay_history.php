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

    <title>Payment History</title>
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="#php">Contact</a></li>
                </ul>
            </nav><!-- .navbar -->



            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
        <a class="log_btn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header><!-- End Header -->
<center>
    <div class="pay-text">
        <h2>Payment History</h2>
    </div>
    </center>
    <div class="container">
        <div class="table_div">
            <table id="myTable">
                <tr>
                    <th>Invoice ID</th>
                    <th>Total Meal</th>
                    <th>Meal Type</th>
                    <th>Payment Amount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Payment Date</th>
                </tr>
                <?php
                $user_id= $_SESSION['id'];
                $sql = "SELECT * FROM payment WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
                
                if($num != 0){

                    foreach($result as $row){
                $invoice_id = $row['invoice_id'];
                $t_meal = $row['t_meal'];

                if($row['type_meal'] == '1'){
                    $type_meal = "Lunch";
                }
                else if($row['type_meal'] == '2'){
                    $type_meal = "Dinner";
                }
                else if($row['type_meal'] == '3'){
                    $type_meal = "Lunch & Dinner";
                }

                $p_amount = $row['total'];
                $s_date = date("d M, Y",strtotime($row['s_date']));
                $e_date = date("d M, Y",strtotime($row['e_date']));
                $date_payment =date("d M, Y",strtotime($row['date_payment']));

            

                    
                        echo "<tr>
                        <td>$invoice_id</td>
                    <td>$t_meal </td>
                    <td>$type_meal</td>
                    <td>$p_amount Rs</td>
                    <td>$s_date</td>
                    <td>$e_date</td>
                    <td>$date_payment</td>
                    </tr>";
                    }

                }
                else{
                    echo "<tr>
                    <td colspan='7'>No Payment History</td>
                    </tr>";
                }
                
                ?>
            </table>
        </div>
   
    <div>
        <div>

        </div>
    </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <!-- Vendor JS Files -->

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>