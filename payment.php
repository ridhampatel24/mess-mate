<?php

require 'database/include.php';

if (!isset($_SESSION['user_type']) =='user' && !isset($_SESSION['t_price'])){
  header('location: login.php');
  exit();
}

if(isset($_SESSION['t_price'])){
    $invoice_id = $_SESSION['invoice_id'];
    $discont = $_SESSION['discont'];
    $total = $_SESSION['t_price']-$_SESSION['discont'];
    $date_payment = date("d M, Y");
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_btn'])){

    $user_id = $_SESSION['id'];
    $invoice_id = $_SESSION['invoice_id'];
    $t_meal = $_SESSION['t_meal'];
    $t_price = $_SESSION['t_price'];
    $s_date = $_SESSION['s_date'];
    $e_date = $_SESSION['e_date'];
    $ex_date = $_SESSION['ex_date'];
    $type_meal = $_SESSION['type_meal'];
    $total = $_SESSION['t_price']-$_SESSION['discont'];
    $pay_date = date("d-m-Y H:i:s");
  
    $sql = "INSERT INTO `payment`(`user_id`, `invoice_id`, `t_meal`, `s_date`, `e_date`, `ex_date`, `type_meal`, `total`, `date_payment`) VALUES ('$user_id','$invoice_id','$t_meal','$s_date','$e_date','$ex_date','$type_meal','$total',NOW())";
    $result = mysqli_query($conn,$sql);

    $check_token = "SELECT * FROM `token` WHERE `userid` = '$user_id'";
    $result_check = mysqli_query($conn, $check_token);
    $num = mysqli_num_rows($result_check);


    if($num > 0){
    $sql2 = "UPDATE `token` SET `tokens` = `tokens` + '$t_meal', `start_date` = '$s_date', `end_time` = '$e_date', `estime` = '$ex_date' WHERE `userid` = '$user_id'";
    $result2 = mysqli_query($conn,$sql2);

    if($result && $result2){
        echo "
        <script>
        alert('Payment Successfull');
        window.location.href = 'index.php';
        </script>";
    }
    else{
        echo "
        <script>
        alert('Payment Failed');
        window.location.href = 'index.php';
        </script>";
    }
}else{
    $sql2 = "INSERT INTO `token`(`userid`, `mobno` ,`tokens`, `start_date`, `end_time`, `estime`) VALUES ('$user_id', '$_SESSION[userno]' ,'$t_meal','$s_date','$e_date','$ex_date')";
    $result2 = mysqli_query($conn,$sql2);

    if($result && $result2){
        echo "
        <script>
        alert('Payment Successfull');
        window.location.href = 'index.php';
        </script>";
    }
    else{
        echo "
        <script>
        alert('Payment Failed');
        window.location.href = 'index.php';
        </script>";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script src="https://kit.fontawesome.com/b4acf271a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style2452.css">
    <title>Payment</title>
</head>

<body>

    <div class="container bg-light d-md-flex align-items-center">
        <div class="card box1 shadow-sm p-md-5 p-md-5 p-4">
            <div class="fw-bolder mb-4"><span class="fas fa-indian-rupee-sign"></span><span class="ps-1"><?php echo $_SESSION["t_price"];?></span></div>
            <div class="d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between text"> <span class="">Discount</span>
                   <span class="fas fa-indian-rupee-sign"><span class="ps-1"><?php echo $discont;?></span></span>
                </div>
                <div class="d-flex align-items-center justify-content-between text mb-4"> <span>Total</span> 
                <span class="fas fa-indian-rupee-sign"><span class="ps-1"><?php echo $total;?></span></span> </div>
                <div class="border-bottom mb-4"></div>
                <div class="d-flex flex-column mb-4"> <span class="far fa-file-alt text"><span class="ps-2">Invoice
                            ID:</span></span> <span class="ps-3"><?php echo $invoice_id;?></span> </div>
                <div class="d-flex flex-column mb-5"> <span class="far fa-calendar-alt text"><span class="ps-2">Date Of
                            payment:</span></span> <span class="ps-3"><?php echo $date_payment;?></span> </div>
                <div class="d-flex align-items-center justify-content-between text mt-5">
                    <div class="d-flex flex-column text"> <span>Customer Support:</span> <span>online chat 24/7</span>
                    </div>
                    <div class="btn btn-primary rounded-circle"><span class="fas fa-comment-alt"></span></div>
                </div>
            </div>
        </div>
        <div class="card box2 shadow-sm">
            <div class="d-flex align-items-center justify-content-between p-md-5 p-4"> <span
                    class="h5 fw-bold m-0">Payment
                    methods</span>
                <div class="btn btn-primary bar"><span class="fas fa-bars"></span></div>
            </div>
            <ul class="nav nav-tabs mb-3 px-md-4 px-2">
                <li class="nav-item"> <a class="nav-link px-2 active" aria-current="page" href="#">Credit Card</a> </li>
                <li class="nav-item"> <a class="nav-link px-2" href="upi.php">UPI Payment</a> </li>
                <li class="nav-item ms-auto"> <a class="nav-link px-2" href="#">+ More</a> </li>
            </ul>
            <div class="px-md-5 px-4 mb-4 d-flex align-items-center">
                <div class="btn btn-success me-4"><span class="fas fa-plus"></span></div>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group"> <input type="radio"
                        class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked> <label
                        class="btn btn-outline-primary" for="btnradio1"><span class="pe-1">+</span>5949</label> <input
                        type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"> <label
                        class="btn btn-outline-primary" for="btnradio2"><span class="lpe-1">+</span>3894</label> </div>
            </div>
            <form method="POST">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-column px-md-5 px-4 mb-4"> <span>Credit Card</span>
                            <div class="inputWithIcon"> <input class="form-control" type="text"
                                    placeholder="xxxx xxxx xxxx xxxx">
                                <span class=""> <img
                                        src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-logok-15.png"
                                        alt=""></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column ps-md-5 px-md-0 px-4 mb-4"> <span>Expiration<span
                                    class="ps-1">Date</span></span>
                            <div class="inputWithIcon"> <input type="month" class="form-control"
                                    pattern="/[\d]{2} \/ [\d]{4}/">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column pe-md-5 px-md-0 px-4 mb-4"> <span>Code CVV</span>
                            <div class="inputWithIcon"> <input type="password" class="form-control" placeholder="...">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column px-md-5 px-4 mb-4"> <span>Name</span>
                            <div class="inputWithIcon"> <input class="form-control text-uppercase" type="text"
                                    placeholder="Card Holder's Name"> <span class="far fa-user"></span> </div>
                        </div>
                    </div>
                    <div class="col-12 px-md-5 px-4 mt-3">
                        <button class="btn btn-primary w-100" name="payment_btn" type="submit">Pay <?php echo $total." Rs.";?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>