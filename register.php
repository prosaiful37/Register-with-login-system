<?php require_once "app/db.php"; ?>
<?php require_once "app/function.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/all.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	<?php

		if(isset($_POST['register']) ){
			//get value
			$name = $_POST['name'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			$cell = $_POST['cell'];



			//username check
			$user_name_check = unique($connection, 'user', 'username', $username);
			
			//email check
			$email_check = unique($connection, 'user', 'username', $email);
			
			//cell check
			$cell_check = unique($connection, 'user', 'username', $cell);

			
			//password hash
			$password = $_POST['password'];
			$pass_hash = password_hash( $password, PASSWORD_DEFAULT);	

			//cpassword 
			// $cpass = $_POST['cpass'];
			// if ( $password == $cpass ) {
			// 	$password_check == true;
			// }else{
			// 	$password_check == false;
			// }
			



			if(empty($name) || empty($username) || empty($email) || empty($cell) || empty($password) ){
				 $mess = "<p class='alert alert-danger'>All Filds Are required ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			// }else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
			// 	$mess = "<p class='alert alert-info'> Invalid Email Formate ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			// }elseif($password_check == false ){
			// 	$mess = "<p class='alert alert-warning'> password not match ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif($user_name_check == false){ 
				$mess = "<p class='alert alert-danger'> Username already exits ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif($email_check == false){ 
				$mess = "<p class='alert alert-danger'> Email already exits ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif($cell_check == false){ 
				$mess = "<p class='alert alert-danger'> Cell already exits ! <button class='close' data-dismiss='alert'>&times;</button></p>";
			}else {


				$data = fileUpload($_FILES['photo'], 'photos/student/');
				$photo_name = $data['file_name'];

				if( $data['status'] == 'yes'){
					$sql = "INSERT INTO user(name, username, email, cell, password, photo) VALUES ('$name','$username','$email','$cell','$pass_hash', '$photo_name')";
					$connection -> query($sql);

					setMsg('User registration Successful !');

					header('location:register.php');


					$mess = "<p class='alert alert-success'>Data Stable! <button class='close' data-dismiss='alert'>&times;</button></p>";
				}else{
					$mess = "<p class='alert alert-danger'> Invalid file formate ! <button class='close' data-dismiss='alert'>&times;</button></p>";
				} 

				

			}







		}





	?>

	<div class="wrap shadow">
		<h2>Registration</h2>
		<div class="card">
			<?php

				if (isset($mess)) {
					echo $mess;
				}

				getMsg();
			?>
			<div class="card-body">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" value="<?php echo old('name'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="username" class="form-control" value="<?php echo old('username'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" value="<?php echo old('email'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" value="<?php echo old('cell'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" type="password" id="myInput">
					</div>
					<!-- <div class="form-group">
						<label for="">Confirm password</label>
						<input name="cpass" type="password">
						<br>
						<input type="checkbox" onclick="myFunction()">Show Password
					</div> -->
					<div class="form-group">
						<label for="">Photo</label>
						<input name="photo" class="form-control" type="file">
					</div>
					<div class="form-group">
						<input name="register" class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="index.php">Log in now</a>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		function myFunction() {
		  var x = document.getElementById("myInput");
		  if (x.type === "password") {
		    x.type = "text";
		  } else {
		    x.type = "password";
		  }
		}


	</script>
</body>
</html>