<?php

require 'database/include.php';


if(isset($_POST['pollbtn'])){
    $poll = $_POST['poll'];
    $sql = "SELECT * FROM `poll`";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $options = explode("||||", $row['options']);
    $votes = explode("||||", $row['votes']);
    $users = explode(",", $row['users']);
    $total_votes = $row['total_votes'];
    if($poll == '0'){
        $votes[0] = $votes[0] + 1;
       
    }elseif($poll == '1'){
        $votes[1] = $votes[1] + 1;
}elseif($poll == '2'){
    $votes[2] = $votes[2] + 1;
    
}elseif($poll == '3'){
    $votes[3] = $votes[3] + 1;
}
else{
    echo "
        <script>
            alert('Please select an option');
            window.location.href = 'poll.php';
        </script>";
    exit();
}

$mobile = $_SESSION['userno'];
$sql1 = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
$result1 = mysqli_query($conn, $sql1);
    $row2 = mysqli_fetch_assoc($result1);
$uid = $row2['id'];

if(in_array($uid, $users)){
    echo "
        <script>
            alert('You have already voted');
            window.location.href = 'index.php';
        </script>";
    exit();
}else{
$row['users'] = $row['users'] .','.$uid;
$sql = "UPDATE `poll` SET `votes` = '$votes[0]||||$votes[1]||||$votes[2]||||$votes[3]'  WHERE `poll`.`id` = 1";
$result = mysqli_query($conn, $sql);
$sql2 = "UPDATE `poll` SET `users` = '$row[users]'  WHERE `poll`.`id` = 1";
$result2 = mysqli_query($conn, $sql2);
$total_votes = $total_votes + 1;
$sql3 = "UPDATE `poll` SET `total_votes` = '$total_votes'  WHERE `poll`.`id` = '$uid'";
$result3 = mysqli_query($conn, $sql3);
echo "
    <script>
        window.location.href = 'index.php';
    </script>";
}
}else{
    echo "
        <script>
            window.location.href = 'adminpoll.php';
        </script>";
    exit();
}

?>