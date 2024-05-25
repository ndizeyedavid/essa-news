<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db = "news";

$con = mysqli_connect($hostname, $username, $password, $db);
if (!$con){
	die("Connection failed");
}
?>