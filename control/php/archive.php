<?php
include "include.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $archive = mysqlI_query($con, "UPDATE english SET archive='1' WHERE id='$id'");
    if ($archive) {
        $out = "
            <script>
            alert('Story Archived');
            window.location.assign('../news.php');
            </script>
        ";
    } else {
        $out = "
            <script>
            alert('Operation Failed. Please try again');
            window.location.assign('../news.php');
            </script>
            ";
    }
    echo $out;
}
