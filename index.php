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
			</div>
		</div>

		<div class="row first">
			<div class="col-md-6">
				<div class="input-group username">
					<input type="text" class="form-control username" placeholder="Username" > 
				</div> 
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" class="form-control full-name" placeholder="Full Name" > 
				</div> 
			</div>
		</div>

		<div class="row second">
			<div class="col-md-6">
				<div class="input-group pass">
					<input type="text" class="form-control pass" placeholder="Password" > 
				</div> 
			</div>
			<div class="col-md-6">
				<div class="input-group">
					<input type="text" class="form-control repeat-pass" placeholder="Repeat Password" > 
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
					<input type="text" class="form-control age" placeholder="Age" > 
				</div> 
			</div>
		</div>

		<div class="row fourth">
		<div class="col-md-6">
			<div class="dropdown">
			  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			    Dropdown
			    <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			    <li><a href="#">Action</a></li>
			    <li><a href="#">Another action</a></li>
			    <li><a href="#">Something else here</a></li>
			    <li><a href="#">Separated link</a></li>
			  </ul>
			</div>
		</div>

			<div class="col-md-6 ">
				<button class="btn btn-info submit-btn" type="submit">Let's go</button>
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


