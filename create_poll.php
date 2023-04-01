<?php

require 'database/include.php';

if(isset($_POST['create'])){

    $tdate = date("Y-m-d");
    $check = "SELECT * FROM `poll` WHERE `last_date` >= '$tdate'";
    $result = mysqli_query($conn, $check);
    $num = mysqli_num_rows($result);
    if($num > 0){
        echo "
            <script>
                alert('You can only create one poll at a time');
                window.location.href = 'admin_profile.php';
            </script>";
        exit();
    }else{
    $que = $_POST['que'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];

    $dateaftertomorrow = date('Y-m-d', strtotime($tdate. ' + 2 days'));

    $votes = "0||||0||||0||||0";

    $opt = $opt1."||||" . $opt2."||||" . $opt3."||||" . $opt4;

    $sql = "INSERT INTO `poll`(`pol`, `options`,`votes` ,`date`,`last_date`) VALUES ('$que','$opt', '$votes' ,'$tdate', '$dateaftertomorrow')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo "
        <script>
            alert('Poll Created');
            window.location.href = 'admin_profile.php';
        </script>";
}
}


?>