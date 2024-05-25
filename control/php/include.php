<?php

$hostName = "localhost";
$userName = "root";
$password = "";
$db = "news";

$con = mysqli_connect($hostName, $userName, $password, $db);

if (!$con) {
    die("Could not connect to database");
}
