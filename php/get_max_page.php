<?php
	include("config_local.php");
	session_start();

	$sql = "SELECT MAX(meme_id) FROM memes";
	$result = mysqli_query($con, $sql);
	$row	= $result->fetch_assoc();
	$maxID	= $row["MAX(meme_id)"];

	define("MEMES_PER_PAGE", 12);

	$max_page = ceil($maxID / MEMES_PER_PAGE);

	$con->close();
?>