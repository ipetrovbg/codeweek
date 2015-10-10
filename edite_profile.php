<?php
if (isset($_POST['upload'])) {
		if(!empty($_FILES))		{

			if (!empty($_FILES['userphoto']['tmp_name'])) {
				$user = $_SESSION['user'];
				$select_user = "SELECT id FROM users WHERE user_name = '$user'";
				$qu = mysqli_query($connect, $select_user);
				$r = mysqli_fetch_assoc($qu);
				$file_tmp = $_FILES['userphoto']['tmp_name'];
				$file_type = $_FILES['userphoto']['type'];
				$userphoto = $_FILES['userphoto']['name'];
				$new_pic = 'pics/'.$userphoto;


				// start watermark
				$stamp = "images/p.png";
				echo $stamp;
				$im = $new_pic;
				$marge_right = 10;
				$marge_bottom = 10;
				$sx = imagesx($stamp);
				$sy = imagesy($stamp);
				$n = imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
				// end watermark


				$update = "UPDATE `users` SET `pic`='$n' WHERE  `id` = $r[id]";
				move_uploaded_file($file_tmp, $im);

				if (mysqli_query($connect, $update)) {

					echo "Success!";

				}else{

					echo 'NOT Success!';

				}
				
			}
			
			
		}
		
		
	}
?>
