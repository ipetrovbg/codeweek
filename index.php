<?php
session_start();
require_once('config.php');

if (!$_SESSION) {

		if (isset($_POST['login'])) {
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);
			if (strlen($username) >= 5) {
				if (strlen($password) >= 5) {
					$password = sha1($password);

					$select_user = "SELECT * FROM users WHERE users.user_name = '$username' AND users.password = '$password'";

					$query_info = mysqli_query($connect, $select_user)or die(mysqli_error());
					$row = mysqli_fetch_assoc($query_info);
					$_SESSION['user'] 		= 		$row['user_name']; // създавам сесия
					echo  $_SESSION['user'];
					header('location: index.php');
				}
			}
		}else{
	
	}

	
}else{

	//header('location: dashboard.html'); // логнал се потребител се опитва да влезе в login.php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<title>File Holder</title>
	<meta name="description" content="Project CodeWeek - 'File Hoder'">
	<meta name="author" content="">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style-index.css">
	<link rel="stylesheet" href="css/scrolling-nav.css">
	<link rel="stylesheet" href="css/style-dashboard.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">

	<!-- ............................ START JUMBOTRON ............................-->

</head>
<body>

	<div class="jumbotron">
		<nav class="navbar navbar-default fixed cl-effect-14">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
				<a class="navbar-brand" href="">Brand</a>
		    </div>

		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="active"><a href="dashboard.html">Dashboard <span class="sr-only">(current)</span></a></li>
		        <li><a href="#services" class="page-scroll">About</a></li>
		        <li><a href="#">My Files</a></li>
		        <li><a href="#">All Users</a></li>
		        <li><a href="logout.php">Exit</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>  <!-- end navigation -->
	
		<div class="container">
			<div class="row hero">

				<div class="col-md-6 left">
					<h1>Hello, We are <span>File Holder</span></h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
					<img src="images/index/bird.png" alt="Bird.png">
				</div>
				<?php
					if (!$_SESSION) {
						
				?>
				<form method="post" action="" enctype="multipart/form-data">
					<div class="col-md-6 right">
						<h1>Log in to your account</h1>
				
						<div class="input-group">
							<input type="text" name="username" class="form-control username" placeholder="Username" > 
						</div> 
						<div class="input-group">
							<input type="password" name="password" class="form-control password" placeholder="Password" > 
						</div> 
						<button name="login" class="btn btn-info submit-btn" type="submit">Let's go</button>
					</div>	
				</form>
				<?php					
					}else{
						echo $_SESSION['user'];
					}
				?>
			</div> <!-- end hero content -->
		</div> 
	</div>


<!-- ............................ START SIGN UP ............................ -->
<form method="post" action="" enctype="multipart/form-data">
<div class="sign-up">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Sign Up <span>For Free</span></h1>

				<?php 
				
					if (isset($_POST['register'])) {
						if(!empty($_FILES)){
							if (!empty($_FILES['userphoto']['tmp_name'])) {
								$username = $_POST['username'];
								$password = $_POST['password'];
								$password_repeat = $_POST['password_repeat'];
								//$description = $_POST['description'];
								$full_name = $_POST['full_name'];
								$age = $_POST['age'];
								$gender = $_POST['gender'];
								$file_tmp = $_FILES['userphoto']['tmp_name'];
								$file_type = $_FILES['userphoto']['type'];
								$userphoto = $username.'-'.time().'-'.$_FILES['userphoto']['name'];
								$new_pic = 'pics/'.$userphoto;
							//validation
							//username

								$username_q = "SELECT user_name	FROM users WHERE user_name = '$username'";
								$username_result = mysqli_query($connect, $username_q) or die (mysqli_error());
								$numUsers 		= 		mysqli_num_rows($username_result);
								if ($numUsers == 0) {

									if ($password == $password_repeat) {

										$password = sha1($password);

											$reg_q = "INSERT INTO `users`(`user_name`, `password`, `full_name`, `age`, `sex`, `pic`)
											VALUES ('$username','$password', '$full_name', '$age', '$gender', '$new_pic')";
											
											if (mysqli_query($connect, $reg_q)) {

												echo "Successful registration! <br />";
												move_uploaded_file($file_tmp, $new_pic);


											}else{
												echo 'something wrong';
											}
									} else{

										echo "Password doesn`t match! Please enter again!";
									}

									
								}else{
									echo "Username is not available! Please choose another one!";
								}
								
							
							}
						}
					}
					?>

			</div>
		</div>

		<div class="row first">
			<div class="col-md-6">
				<div class="input-group username">
					<input type="text" class="form-control username" name="username" placeholder="Username" > 
				</div> 
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" class="form-control full-name" name="full_name" placeholder="Full Name" > 
				</div> 
			</div>
		</div>

		<div class="row second">
			<div class="col-md-6">
				<div class="input-group pass">
					<input type="password" class="form-control pass" name="password" placeholder="Password" > 
				</div> 
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<input type="password" class="form-control repeat-pass" name="password_repeat" placeholder="Repeat Password" > 
				</div> 
			</div>
		</div>

		<div class="row third">
			<div class="col-md-6">
				<div class="input-group email">
					<input type="text" class="form-control email" placeholder="E-mail" > 
				</div> 
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" class="form-control age" name="age" placeholder="Age" > 
				</div> 
			</div>
		</div>
		<div class="row fifth">
			<div class="col-md-12">
				<div class="input-group">
					<input type="file" class="form-control file" name="userphoto" placeholder="file" > 
				</div> 
			</div>
		</div>
		<div class="row fourth">
		<div class="col-md-6">
			<input type="radio" name="gender"
			<?php if (isset($_POST['gender']) && $_POST['gender']=="female") echo "checked";?>
			value="female">Women
			<input type="radio" name="gender"
			<?php if (isset($_POST['gender']) && $_POST['gender']=="male") echo "checked";?>
			value="male">Men
		</div>

			<div class="col-md-6 ">
				<button class="btn btn-info submit-btn" name="register" type="submit">Let's go</button>
			</div>
		</div>

	</div>
</div>
</form>
<!-- ............................ START SIGN UP ............................ -->

<footer>
	<h2>copyrights</h2>
</footer>

<!-- ............................ END PROJECT ............................ -->


	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
	<script>new WOW().init();</script>
	<script src="js/scrolling-nav.js"></script>
	<script src="js/jquery.easing.min.js"></script>

</body>
</html>


