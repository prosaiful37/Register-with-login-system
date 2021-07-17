
<?php require_once "app/db.php"; ?>
<?php require_once "app/function.php"; ?>
<?php 


	//session start
	session_start();
	
	/**
	 * User session check
	 */
	if (isset($_SESSION['id']) AND isset($_SESSION['email']) AND isset($_SESSION['username'])) {
		//Redirect user profile
		header('location:home.php');
	}

	/**
	 * relogin system
	 */
	if (isset($_COOKIE['relog'])) {
		
		//cookie user id

		$user_id = $_COOKIE['relog'];

		$sql = "SELECT * FROM user WHERE id='$user_id'";
		$data = $connection -> query($sql);
		$login_user = $data -> fetch_assoc();


		//session data
		$_SESSION['id'] = $login_user['id'];
		$_SESSION['name'] = $login_user['name'];
		$_SESSION['username'] = $login_user['username'];
		$_SESSION['email'] = $login_user['email'];
		$_SESSION['cell'] = $login_user['cell'];
		$_SESSION['photo'] = $login_user['photo'];

		//redirect user profile
		header("location:home.php");
	}



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

	<?php 

		if (isset($_POST['login'])) {
			// get value

			$ue = $_POST['ue'];
			$pass = $_POST['pass'];


			/**
			 * form validation
			 */

			if (empty($ue) || empty($pass) ) {
				$mess = "<p class='alert alert-danger'>All Filds Are required ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			}else{


				$sql = "SELECT * FROM user WHERE username='$ue' || email='$ue' ";
				$data = $connection -> query($sql);
				$login_user = $data -> fetch_assoc();



				/**
				 * email & username varify
				 */
				if ($data -> num_rows == 1) {
					
					/**
					 * password varify
					 */
					if (password_verify($pass, $login_user['password']) == true) {

						//session start
						session_start();

						//session data
						$_SESSION['id'] = $login_user['id'];
						$_SESSION['name'] = $login_user['name'];
						$_SESSION['username'] = $login_user['username'];
						$_SESSION['email'] = $login_user['email'];
						$_SESSION['cell'] = $login_user['cell'];
						$_SESSION['photo'] = $login_user['photo'];

						//relog system
						setcookie('relog', $login_user['id'], time() + (60*60*24*365*10) );




						//redirect user profile
						header("location:home.php");
					}else{
						$mess = "<p class='alert alert-danger'> Wrong Password <button class='close' data-dismiss='alert'>&times;</button></p>";
					}


				}else{
					$mess = "<p class='alert alert-danger'> Wrong username! | Email <button class='close' data-dismiss='alert'>&times;</button></p>";
				}



			}


		}




	 ?>
	
	

	<div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Log in</h2>
				<?php 

					if (isset($mess)) {
					echo $mess;
				}


				
				 ?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group">
						<label for="">Email / Username</label>
						<input name="ue" class="form-control" value="<?php echo old('ue') ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="pass" class="form-control" type="Password">
					</div>
					<div class="form-group">
						<input name="login" class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="register.php">Create a new account</a>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>