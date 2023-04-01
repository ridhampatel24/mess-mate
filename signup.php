<?php

require 'database/include.php';
if(isset($_SESSION['user'])){
	header('location: home.php');
	exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
    
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $cpass = $_POST['cpass'];

    if($pass == $cpass){

        $sql1 = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
		$stmt1 = $conn->prepare($sql1);
		$stmt1->execute();
		$user1 = $stmt1->fetch();
        

        if($user1){
            echo "
                <script>
                    alert('Mobile Number already exists');
                    window.location.href = 'signup.php';
                </script>";
            exit();
        }else{
        $pass = md5($pass);
        $sql = "INSERT INTO `users`(`name`, `mobile`, `password`, `email`) VALUES ('$name','$mobile','$pass','$email')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
       
        echo "
            <script>
                alert('Registration Successful');
                window.location.href = 'login.php';
            </script>";
        }
    }else{
     echo"
            <script>
                alert('Password and Confirm Password does not match');
                window.location.href = 'signup.php';
            </script>";
    }

	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mess Mate-Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	

<!--===============================================================================================-->

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/log_main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assets/dinner.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post" action="signup.php">
					<span class="login100-form-title">
						Register
					</span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" required name="name" placeholder="Name " maxlength="20">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email"  required name="email" placeholder="Email" maxlength="40">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
                    
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="mobile" required placeholder="Mobile no" maxlength="10">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" required placeholder="Password"  >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="cpass" required placeholder="Confirm Password"  >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="register">
							Register
						</button>
					</div>

					<div class="text-center p-t-40">
						<a class="txt2" href="login.php">
							Already have an Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	
<!--===============================================================================================-->	
	<script src="vendorlogin/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/bootstrap/js/popper.js"></script>
	<script src="vendorlogin/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/login.js"></script>

</body>
<script>

</script>
</html>