<?php

require 'database/include.php';

if ($_SESSION['user_type'] != 'admin') {
    header('location: login.php');
    exit();
  }

if(isset($_POST['delete_lunch'])){
    $tdate = date('Y-m-d');
    $lunch_id = $_POST['lunch_id'];
    $sql = "DELETE FROM `meal` WHERE `meal`.`id` = '$lunch_id' AND `meal`.`type` = '0'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "
        <script>
            alert('Lunch Deleted');
            window.location.href = 'admin_index.php';
        </script>";
    }else{
        echo "
        <script>
            alert('Lunch Not Deleted');
            window.location.href = 'admin_index.php';
        </script>";
    }
}
elseif(isset($_POST['delete_dinner'])){
    $tdate = date('Y-m-d');
    $sql = "DELETE FROM `meal` WHERE `meal`.`id` = '$dinner_id' AND `meal`.`type` = '1'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "
        <script>
            alert('Dinner Deleted');
            window.location.href = 'admin_index.php';
        </script>";
    }else{
        echo "
        <script>
            alert('Dinner Not Deleted');
            window.location.href = 'admin_index.php';
        </script>";
    }
}else{
    echo "
        <script>
            alert('Something Went Wrong');
            window.location.href = 'admin_index.php';
        </script>";
}





?>