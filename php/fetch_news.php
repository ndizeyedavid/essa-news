<?php
sleep(1);
include "include.php";

$id = $_GET['id'];

$fetch = mysqli_query($con, "SELECT * FROM english WHERE id='{$id}'");

$data = mysqli_fetch_array($fetch);

$img = $data['image'];
$title = $data['title'];
$subject = $data['subject'];
$full = $data['Full_news'];

echo "

<div class='full-news-img'>
    <img src='control/images/$img'>
</div>
<h3 class='title'>$title</h3>
<article class='full-news'>
    $subject <br><br>
    $full
</article>

";
$views = mysqli_query($con, "UPDATE english SET views=views+1 WHERE id='{$id}'");
