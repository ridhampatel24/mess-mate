    <?php

    require 'database/include.php';

    if ($_SESSION['user_type'] != 'admin') {
        header('location: login.php');
        exit();
      }
    $date = date("Y-m-d");
    $sql = "SELECT * FROM meal WHERE `date` = '$date'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $users = explode(",", $row['users']);
        if($row['type']=='1'){
            $type = 'Lunch';
        }else{
            $type = 'Dinner';
        }

        $cost = $row['price'];

        for($i=count($users)-1; $i>=0; $i--){
            $sql = "SELECT * FROM users WHERE `id` = '$users[$i]'";
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $name = $row2['name'];
            echo "
            <div class='lm_container' id='lm_container'>
            <div class='meal'>
        <div class='img'>
            <img src='assets/user.png' alt='' height='100px' width='100px'>
        </div>
        <div class='content'>
            <div class='name'>
                <p>$name</p>
            </div>
            <div class='date'>
                <p>Date : $date</p>
            </div>
            <div class='type'>
                <p>Meal Type: $type </p>
            </div>
            <div class='price'>
                <p>Cost: Rs. $cost</p>
            </div>
        </div>
    </div>
    </div>";
        }
    }
    ?>