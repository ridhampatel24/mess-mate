<?php

require 'database/include.php';

if(isset($_SESSION['user'])){
	header('location: home.php');
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

		$mobile = $_POST['mobile'];
		$pass = md5 ($_POST['pass']);

		$sql = "SELECT * FROM `users` WHERE `mobile` = '$mobile'  AND `password` = '$pass' ";
		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		if($user){
			$_SESSION['userno'] = $mobile;
			$_SESSION['user_email'] = $user['email'];
			$_SESSION['id'] = $user['id'];

			if($user['id'] == '9999'){
				$_SESSION['user_type'] = "admin";
				echo "
				<script>
					window.location.href = 'admin_profile.php';
				</script>";
			}
			else{
				$_SESSION['user_type'] = "user";
				echo "
				<script>
					window.location.href = 'index.php';
				</script>";
			}

			
		}else{
			echo "
				<script>
					alert('Invalid Mobile or Password');
					window.location.href = 'login.php';
				</script>";
		}

	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mess Mate-Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
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

				<form class="login100-form validate-form" method="post" action="login.php">
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" required name="mobile" placeholder="Mobile no">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" required name="pass" placeholder="Password"  >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="signup.php">
							Create your Account
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
</html>