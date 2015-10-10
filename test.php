<?php 
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'documents');
if (!$conn) {
	die("Connection failed: mysqli_connect_error()"); 
} else {
	//echo "Connected successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title><!-- Latest compiled and minified CSS -->

</head>
<body>


	<div class="container">
		<div class="row">
			<div class="col-md-5 col-md-offset-1">
				<br/>
				<form method="post" action="login.php" class="form-horizontal">	
					<div class="form-group">
						<label for="user_name" class="col-md-3 control-label">user_name</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="user_name" id="user_name" placeholder="user_name">
						</div>
					</div> <!-- END user_name -->

					<div class="form-group">
						<label for="password" class="col-md-3 control-label">Password</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						</div>
					</div> <!-- END PASSWORD -->

					<div class="form-group">
						<label for="rpass" class="col-md-2 control-label reppass">Repeat&nbsp;Pass</label>
						<div class="col-md-8 col-md-offset-1">
							<input type="password" class="form-control" name="password_repeat" id="rpass" placeholder="Repeat Password">
						</div>
					</div> <!-- END REPEAT PASSWORD -->

					<div class="form-group">
						<label for="email" class="col-md-3 control-label">Email</label>
						<div class="col-md-8">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email">
						</div>
					</div> <!-- END EMAIL -->

					<div class="form-group">
						<label for="fn" class="col-md-3 control-label">First Name</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="full_name" id="fn" placeholder="First Name">
						</div>
					</div> <!-- END FIRST NAME -->

					<div class="form-group">
						<label for="ln" class="col-md-3 control-label">Last Name</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="last_name" id="ln" placeholder="Last Name">
						</div>
					</div> <!-- END LAST NAME -->

					<div class="form-group">
						<label for="age" class="col-md-3 control-label">Age</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="age" id="age" placeholder="Age">
						</div>
					</div> <!-- END AGE -->


					<div class="form-group">
						<label for="file" class="col-md-3 control-label">Photo</label>
						<div class="col-md-8">
							<input type="file" name="userphoto" />
						</div>
					</div> <!-- END AGE -->

					<hr>
					<div class="form-group">
						<label for="age" class="col-md-3 control-label">Register</label>
						<div class="col-md-6 submitcss">
							<button type="submit" value="submit" name="submit" class="btn btn-success btn-block">Count Me In
							</button>
						</div>
					</div> <!-- END SUBMIT -->
				</form>
			</div> <!-- END LEFT COLUMN -->

			<div class="col-md-5">


				<?php 
				if (!empty($_POST)) {
					if(!empty($_FILES)) {
						if (!empty($_FILES['use­rphoto']['tmp_name'])) {
							$user_name = $_POST['user_name'];
							$password = $_POST['password'];
							$password_repeat = $_POST['password_repeat'];
							$email = $_POST['email'];
							$full_name = $_POST['full_name'];
							$sex=$_POST['sex'];
							$age = $_POST['age'];
							$file_tmp = $_FILES['userphoto']['tmp_name'];
							$file_type = $_FILES['userphoto']['type'];
							$userphoto = $_FILES['userphoto']['name'];
							$new_pic = 'pics/'.$userphoto;
	//validation
	//user_name
							$user_name_q = "SELECT user_name FROM users";
							$user_name_result = mysqli_query($conn, $user_name_q);
							$flag = 0;

							if (mysqli_num_rows($user_name_result) > 0) {
								while ($user_name_row = mysqli_fetch_assoc($user_name_result)) {
									foreach ($user_name_row as $value) {
										if ($user_name_row['user_name'] == $user_name) {
											$flag = 1;
										}								
									}
								}
							}

							if ($flag == 1) {

								echo "<span class='label label-danger'>user_name is already taken</span><br/><br/>";
								if($password !== $password_repeat) {
									echo "<span class='label label-danger'>Password doesn`t match!</span>";
								}
							}

							elseif ($password !== $password_repeat) {
								echo "<span class='label label-danger'>Password doesn`t match!</span>";
							} else {
								$password=Sha1($password);
								$reg_q = "INSERT INTO `users`(`user_name`, `password`, `email`, `full_name`, `age`, `sex`, `pic` );
								VALUES ('$user_name','$password','$email','$full_name', '$age', '$sex', '$new_pic')";
								move_uploaded_file($file_tmp, $new_pic);
								if (mysqli_query($conn, $reg_q)) {
									echo "<span class='glyphicon glyphicon-ok iconCss' aria-hidden='true'></span>&nbsp;&nbsp;&nbsp;";
									echo "Successful registration! <br/><br/>";
									echo "<a href='login.php' class='btn btn-info btn-sm'>Log In To Your Account</a>";
								}
							}
						}
					}
				}

				?>
			</div>


		</div>
	</div>
</body>
</html>
