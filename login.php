<?php
session_start();
require_once('config.php');
?>
<form method="post" action="">
			<input type="text" name="username"><br />
			<input type="password" name="password"><br />
			<input type="submit" name="login" value="LOGIN">
		</form>
<?php
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

	header('location: index.php'); // логнал се потребител се опитва да влезе в login.php
}
?>	