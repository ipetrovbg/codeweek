<?php

//$connect = mysqli_connect('localhost', 'root', 'p8908271860', 'vratsad_foods_project');
$connect = mysqli_connect("localhost", "root", "p8908271860", 'documents');
mysqli_set_charset($connect, "utf8");
if (!$connect) {
	
	die("Connection failed: " . mysqli_connect_error());

}