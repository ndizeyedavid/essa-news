<?php

include "include.php";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $fetch = mysqli_query($con, "SELECT * FROM english WHERE id ='{$id}'");
    $data = mysqli_fetch_array($fetch);

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $story = mysqli_real_escape_string($con, $_POST['story']);
    $date = date("Y-m-d");

    $img = $_FILES['img']['name'];
    $ext = explode(".", $img);
    $img_name = rand() . '.' . $ext[0];
    if (empty($category)) {
        $category = $data['subject'];
    }

    if (empty($img)) {
        $img_name = $data['image'];
    } else {
        $upload = move_uploaded_file($_FILES['img']['tmp_name'], "../images/$img_name");
    }

    $update = mysqli_query($con, "UPDATE english SET title = '{$title}', subject='{$category}', image='{$img_name}', Full_news='{$story}' WHERE id='{$id}'");
    if ($update) {
        $out = "
        <script>
        alert('Story Updated Successfully');
        window.location.assign('../news.php');
        </script>
        ";
    } else {
        $out = "
        <script>
        alert('Operation Failed');
        window.location.assign('../news.php');
        </script>
        ";
    }
    echo $out;
}
