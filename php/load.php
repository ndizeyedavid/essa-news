<?php
include "include.php";

$device = $_GET['device'];
$browser = $_GET['browser'];

$insert = mysqli_query($con, "INSERT INTO visits(device, browser) VALUES ('{$device}', '{$browser}')");

if (!$insert) {
    echo "Not registered";
}
