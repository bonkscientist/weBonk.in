<?php

include("config_local.php");
session_start();

// Constants
define ("POSTS_PER_ROW", 	4);
define ("ROWS_PER_PAGE",	3);
define ("MEMES_PER_PAGE", 12);

$current_page = 1;
$sort = 1;
$meme_count = 1;
$row_count = 1;
$row_open = FALSE;
$page_end = FALSE;

if (isset($_POST['new_page'])) {
	$current_page = $_POST['new_page'];
}

if (isset($_POST['sort'])) {
	$sort = $_POST['sort'];
}

$start_position = ($current_page * MEMES_PER_PAGE) - (MEMES_PER_PAGE - 1);
$end_position = $start_position + MEMES_PER_PAGE;
$sql = "SELECT * FROM memes ORDER BY posted_on";
$results = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($results)) {
	$data[] = $row;
}

//	Reverse to sort by newest
if ($sort == 1) {
	rsort($data);
}


$last_element = end($data);

for ($index = $start_position; ($index < $end_position) && ($page_end == FALSE); $index++) {
//while (($row = mysqli_fetch_assoc($results)) && ($page_end == FALSE)) {
	if ($meme_count == 1) {
		echo '<div class="row">';
		$row_open = TRUE;
	}

	echo '<div class="col s12 m6 l3">';
	echo 	'<a class="meme-btn" onclick="loadMemePage(' .$data[$index]["meme_id"]. ')">';
	echo 		'<div class="card black">';
	echo 			'<div class="card-image">';
	echo 				'<img src="img/memes/' .$data[$index]["url"]. '">';
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

	if ($data[$index] == $last_element) {
		$page_end = TRUE;
	}


}

if ($row_open == TRUE) {
	echo '</div>';
}

?>