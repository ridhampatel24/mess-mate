<script src="assets/js/html5-qrcode.min_.js"></script>
<?php
require 'database/include.php';

if (!isset($_SESSION['userno'])) {
    header('location: login.php');
    exit();
}


if (isset($_POST['result'])) {
    $_SESSION["scan_value"] = $_POST['result'];

    $str = explode("^", $_POST['result']);

    $sql1 = "SELECT * FROM `meal` WHERE `id` = '$str[0]'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $users1 = explode(",", $row1['added_user']);

    $sql3 = "SELECT * FROM `meal` WHERE `id` = '$str[0]'";
    $result3 = mysqli_query($conn, $sql1);
    $row3 = mysqli_fetch_assoc($result1);
    $users3 = explode(",", $row1['users']);

    if (in_array($_SESSION['id'], $users3)) {
        echo "<script>alert('You already Take meal!');
        window.location.href = 'profile.php';</script>";
    }
    else{
        if (in_array($_SESSION['id'], $users1)) {
            
            if($row1['users'] == ""){
                $row1['users'] = $_SESSION['id'];
            }else{
                $row1['users'] = $row1['users'] .','.$_SESSION['id'];
            }
            $sql2 = "UPDATE `meal` SET `users`= '$row1[users]' WHERE `id` = '$str[0]'";
            $result2 = mysqli_query($conn, $sql2);

        } else {
            if($row1['users'] == ""){
                $row1['users'] = $_SESSION['id'];
            }else{
                $row1['users'] = $row1['users'] .','.$_SESSION['id'];
            }

            if($str[1]==0){
                $sql = "UPDATE `token` SET `tokens`=`tokens`-1 WHERE `userid` = '$_SESSION[id]'";
            }
            else{
                $sql = "UPDATE `token` SET `d_tokens`=`d_tokens`-1 WHERE `userid` = '$_SESSION[id]'";
            }
            
            $sql2 = "UPDATE `meal` SET `users`= '$row1[users]' WHERE `id` = '$str[0]'";
            $sql_dec = "UPDATE `meal` SET `wastage_user`=`wastage_user`-1 WHERE `id` = '$str[0]'";

            $result_dec = mysqli_query($conn, $sql_dec);
            $result2 = mysqli_query($conn, $sql2);
            $result = mysqli_query($conn, $sql);
        }
        echo "<script>
        window.location.href = 'profile.php';</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qr scaner</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/scan.css">


</head>

<body>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="reader" id="reader"></div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col" style="padding:30px;">
                <h4>SCAN RESULT</h4>
                <div id="result">Result Here</div>
            </div>
        </div> -->
        <center>
            <div class="scan_btn"><button onclick="myFunction()">Scan</button></div>
        </center>
        <form method="POST" id="scan_form" name="scan_form"><input type="hidden" id="result" name="result"></form>
    </div>

</body>
<script type="text/javascript">
    function myFunction() {
        var but1 = document.getElementById('reader__dashboard_section_csr');
        console.log(but1);
        (but1.children[0]).children[0].click();

        setTimeout(function myfun() {
            console.log('hello');
            var but2 = document.getElementById('reader__dashboard_section_csr');
            var buttons = but2.getElementsByTagName('button');
            buttons[0].click();
        }, 3000);
    }


    function onScanSuccess(qrCodeMessage) {
        document.getElementById('result').value = qrCodeMessage;
        var ans = confirm("Are you sure?");
        if (ans) {
            document.getElementById('scan_form').submit();
        }

    }

    function onScanError(errorMessage) {
        console.log(errorMessage);
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 250
        });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>

</html>