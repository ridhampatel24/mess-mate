

<?php
require 'database/include.php';

if(isset($_SESSION['user'])){
	header('location: home.php');
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $val = $_POST['feedback'];
    $msg = $_POST['message'];

    $mobile = $_SESSION['userno'];
    $sql1 = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
    $result1 = mysqli_query($conn, $sql1);
    $row2 = mysqli_fetch_assoc($result1);
    $uid = $row2['id'];
    $name = $row2['name'];

    $sql = "INSERT INTO `feedback` (`user_id`, `name`,`datetime`, `feedback`, `rate`) VALUES ('$uid','$name' ,current_timestamp(), '$msg', '$val')";
    $result1 = mysqli_query($conn, $sql);

    if($result1){
        header('location: profile.php');
        exit();
    }
    else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

?>