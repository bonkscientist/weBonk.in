<?php

include("config_local.php");
session_start();

$sql     = "SELECT * FROM memes WHERE meme_id = " .$_POST['id'];
$results = mysqli_query($con, $sql);
$result  = mysqli_fetch_assoc($results);

if (isset($result["title"])) {
	echo '<h2 class="center-align">' .$result["title"]. '</h2>';
}

echo '<img src="img/memes/' .$result["url"]. '" id="mp-img" class="center">';

$con->close();

?>