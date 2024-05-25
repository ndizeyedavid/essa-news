<?php
include "include.php";

if (isset($_POST['submit'])) {
    $id = rand();
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $subject = mysqli_real_escape_string($con, $_POST['category']);
    $news = mysqli_real_escape_string($con, $_POST['story']);
    $date = date("Y-m-d");

    $img = $_FILES['img']['name'];
    $ext = explode(".", $img);
    $ext = end($ext);

    $img_name = "$id.$ext";
    $upload = move_uploaded_file($_FILES['img']['tmp_name'], "../images/$img_name");
    if ($upload) {
        $insert = mysqli_query($con, "INSERT INTO english(image, title, subject, Full_news, news_date) VALUES('{$img_name}', '{$title}', '{$subject}', '{$news}', '{$date}')");
        if ($insert) {
            $out = "
            <script>
            alert('Story Posted Successfully');
            window.location.assign('../news.php');
            </script>
            ";
        } else {
            $out = "
            <script>
            alert('An error occurred');
            window.location.assign('../news.php');
            </script>
            ";
        }

        echo $out;
    }
}
