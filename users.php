<?php
session_start();
require_once('config.php');

$select_all_users = "SELECT * FROM users ORDER BY id DESC";
$q_users = mysqli_query($connect, $select_all_users);
if (mysqli_num_rows($q_users) > 0) {
	while ($row = mysqli_fetch_assoc($q_users)) {
		echo $row['full_name'] . '- '. $row['description'] . '<br />';
	}
}
