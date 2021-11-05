<?php

include("config_local.php");
session_start();

// Constants
define ("POSTS_PER_ROW", 	4);
define ("ROWS_PER_PAGE",	3);
define ("MEMES_PER_PAGE", 12);

$current_page = 1;
$meme_count = 1;
$row_count = 1;
$row_open = FALSE;
$page_end = FALSE;

if (isset($_POST['new_page'])) {
	$current_page = $_POST['new_page'];
}

$start_position = ($current_page * MEMES_PER_PAGE) - 7;
$sql = "SELECT * FROM memes LIMIT " .MEMES_PER_PAGE. " OFFSET " .$start_position;
$results = mysqli_query($con, $sql);


while (($row = mysqli_fetch_assoc($results)) && ($page_end == FALSE)) {
	if ($meme_count == 1) {
		echo '<div class="row">';
		$row_open = TRUE;
	}

	echo '<div class="col s12 m6 l3">';
	echo 	'<a class="meme-btn" onclick="loadMemePage(' .$row["meme_id"]. ')">';
	echo 		'<div class="card black">';
	echo 			'<div class="card-image">';
	echo 				'<img src="img/memes/' .$row["url"]. '">';
	echo 			'</div>';
	echo 		'</div>';
	echo 	'</a>';
	echo '</div>';

	if ($meme_count >= POSTS_PER_ROW) {
		echo '</div>';
		$meme_count = 1;
		$row_count++;
		$row_open = FALSE;

		if ($row_count > ROWS_PER_PAGE) {
			$page_end = TRUE;
		} 

	} else {
		$meme_count++;
	}


}

if ($row_open == TRUE) {
	echo '</div>';
}

?>