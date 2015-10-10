<?php
//create connection
$conn = mysqli_connect('localhost', 'root', 'p8908271860', 'documents');
//check connection
if (!$conn) {
	die ("Connection failed: mysqli_connect_error()");
} else {
	//echo "Connected succsessfuly";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title><!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<!--JQuery CDN-->
	<script src="jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 just">
			<?php 
	if (isset($_POST['submit'])) {
if(!empty($_FILES)){
	if (!empty($_FILES['userphoto']['tmp_name'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_repeat = $_POST['password_repeat'];
		$description = $_POST['description'];
		$full_name = $_POST['full_name'];
		$age = $_POST['age'];
		$sex = $_POST['sex'];

		$file_tmp = $_FILES['userphoto']['tmp_name'];
		$file_type = $_FILES['userphoto']['type'];
		$userphoto = $_FILES['userphoto']['name'];
		$new_pic = 'pics/'.$userphoto;
	//validation
	//username

		$username_q = "SELECT user_name	FROM users WHERE user_name = '$username'";
		$username_result = mysqli_query($conn, $username_q) or die (mysqli_error());
		$numUsers 		= 		mysqli_num_rows($username_result);
		if ($numUsers == 0) {

			if ($password == $password_repeat) {

				$password = sha1($password);

					$reg_q = "INSERT INTO `users`(`user_name`, `password`, `full_name`, `description`, `age`, `sex`, `pic`)
					VALUES ('$username','$password', '$full_name', '$description', '$age', '$sex', '$new_pic')";
					
					if (mysqli_query($conn, $reg_q)) {

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
				<div class="first text-center col-xs-6 col-xs-offset-3">
					<p><a href="login.php">log in</a> or fill in the registration form!</p>
					<div class="row">
						<div class="col-xs-8 col-xs-offset-2">
							<form method="post" action="" enctype="multipart/form-data" class="form-horizontal">				
								<div class="form-group ">
									<label for="username">Username</label>
									<input type="text" class="form-control" name="username" id="username">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" name="password" id="password">
								</div>
								<div class="form-group">
									<label for="password_repeat">Repeat Password</label>
									<input type="password" class="form-control" name="password_repeat" id="password_repeat">
								</div>
								
								<div class="form-group">
									<label for="first_name">Full Name</label>
									<input type="text" class="form-control" name="full_name" id="first_name">
								</div>
								<div class="form-group">
									<label for="age">Sex</label>
									<input type="dropdown" class="form-control" name="sex" id="sex">
								</div>
								<div class="form-group">
									<label for="age">Age</label>
									<input type="text" class="form-control" name="age" id="age">
								</div>
								<div class="form-group">
									<label for="file" class="col-md-3 control-label">Photo</label>
									<div class="col-md-8">
										<input type="file" name="userphoto" />
									</div>
									<textarea name="description"></textarea>
									<div class="form-group">
										<button type="submit" value="submit" name="submit" class="btn btn-success">Register</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>