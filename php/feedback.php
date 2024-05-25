<?php

include "include.php";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $feedback = mysqli_real_escape_string($con, $_POST['feedback']);

    $insert = mysqli_query($con, "INSERT INTO feedback(name, rating, feedback) VALUES ('{$name}', '{$rating}', '{$feedback}')");
    if ($insert) {
        $out = "
        <script>
        alert('Thanks for your feedback😊!!');
        window.history.back();
        </script>
        ";
    } else {
        $out = "
        <script>
        alert('An error has occurred. Please try again!');
        window.history.back();
        </script>
        ";
    }
    echo $out;
}
