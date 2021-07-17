<?php require_once "app/db.php"; ?>
<?php require_once "app/function.php"; ?>

<?php 
	//session start
	session_start();

	/**
	 * User session check
	 */
	if (!isset($_SESSION['id']) AND !isset($_SESSION['email']) AND !isset($_SESSION['username'])) {
		//Redirect user login
		header('location:index.php');
	}

	

	//logout system
	if (isset($_GET['logout']) AND $_GET['logout'] == 'user_logout') {
		//session destroy
		session_destroy();

		//cookie deseble
		setcookie('relog', '', time() - (60*60*24*365*10) );
		header('location:index.php');
	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION['name']; ?></title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap shadow">
		<div class="card">
			<div class="card-header">
				<h2><?php echo $_SESSION['name']; ?> <a class="btn btn-info btn-sm" href="user.php">All User</a></h2>

			</div>
			<div class="card-body">
				<img style="width: 250px; height: 250px; border: 7px solid white; border-radius: 50%;>" class="d-block mx-auto shadow mb-3" src="photos/student/<?php echo $_SESSION['photo']; ?>" alt="">
				<br>
				<br>
				<table class="table">
					<tr>
						<td>Name</td>
						<td><?php echo $_SESSION['name']; ?></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><?php echo $_SESSION['username']; ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $_SESSION['email']; ?></td>
					</tr>
					<tr>
						<td>Cell</td>
						<td><?php echo $_SESSION['cell']; ?></td>
					</tr>
				</table>
			</div>
			<div class="card-footer">
				<a href="?logout=user_logout">Log Out</a>
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