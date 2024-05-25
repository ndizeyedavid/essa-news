<?php
sleep(1);
include "include.php";

$id = $_GET['id'];

$fetch = mysqli_query($con, "SELECT * FROM english WHERE id='{$id}'");

$data = mysqli_fetch_assoc($fetch);
echo "<h1>" . $data['title'] . "</h1>";
echo "<hr style='width: 100%'>";
echo $data['Full_news'];
