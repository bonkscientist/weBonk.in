<?php
	include("config_local.php");
	session_start();

	$current_page = 1;

	if (isset($_POST['new_page'])) {
		$current_page = $_POST['new_page'];
	}

	$sql = "SELECT id, date, header, body_link, cpp_link, hpp_link FROM posts WHERE id = " . $curPost. "";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "Posted on " . $row["date"]. "<br>
					<h2>" . $row["header"]. "</h2>";
			echo '<div class="headerUL">
					_______________________________________________<br>
					_____________________________________</div><br>';

			if (isset($row["cpp_link"])) {
				echo '<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tabMain">Main</a></li>
					<li><a data-toggle="tab" href="#cpp_text">CPP Snippet</a></li>';

				if (isset($row["hpp_link"])) {
					echo '<li><a data-toggle="tab" href="#hpp_text">HPP Snippet</a></li>';
				}
				echo '</ul>';
			}

			echo '<div class="tab-content">';
			echo '<div id="tabMain" class="tab-pane fade in active">';
			$myfile = fopen($row["body_link"], "r") or die ("Unable to open file!");
			echo fread($myfile, filesize($row["body_link"]));
			fclose($myfile);
			echo '</div>';

			if (isset($row["cpp_link"])) {
				echo '<div id="cpp_text" class="tab-pane fade">';
				$myfile = fopen($row["cpp_link"], "r") or die ("Unable to open file!");
				echo fread($myfile, filesize($row["cpp_link"]));
				fclose($myfile);
				echo '</div>';
			}

			if (isset($row["hpp_link"])) {
				echo '<div id="hpp_text" class="tab-pane fade">';
				$myfile = fopen($row["hpp_link"], "r") or die ("Unable to open file!");
				echo fread($myfile, filesize($row["hpp_link"]));
				fclose($myfile);
				echo '</div>';
			}
			echo '<br><br></div>';
			//  End of Tabs

		}
	} else {
		echo "0 results";
	}

	$conn->close();
?>

