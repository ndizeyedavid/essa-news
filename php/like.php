<?php

include "include.php";

if (isset($_GET['id'])){
	$id = $_GET['id'];

	$like = mysqli_query($con, "UPDATE english SET likes=likes+1 WHERE id='{$id}'");
	if ($like){
		echo "Liked";
	}else{
		echo "😭😭🐖🐽🐷🐗";
	}
}