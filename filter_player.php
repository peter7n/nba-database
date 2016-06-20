<?php

###########################################
# Authors: Peter Nguyen, Louise McGuire
# Date: 3/13/16
# CS 340-400
# Final Project
###########################################

//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","nguyenp2-db","54FWgeS6bXVomguy","nguyenp2-db");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div>
	<h2>NBA Players</h2>
	<table>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Height (in)</th>
			<th>Weight (lbs)</th>
			<th>Team</th>
			<th>Head Coach</th>
		</tr>
		<?php
		if(!($stmt = $mysqli->prepare("SELECT player.first_name, player.last_name, player.height, player.weight, team.name, head_coach.first_name, head_coach.last_name FROM `player` INNER JOIN `player_position` ON player_position.pid = player.id INNER JOIN `position` ON position.id = player_position.pos_id	INNER JOIN `team` ON team.id = player.tid
		INNER JOIN `head_coach` ON head_coach.id = player.cid WHERE position.id = ?"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!($stmt->bind_param("i",$_POST['Position']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($first_name, $last_name, $height, $weight, $team, $coach_fname, $coach_lname)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
			echo "<tr>\n<td>\n" . $first_name . "\n</td>\n<td>\n" . $last_name . "\n</td>\n<td>\n" . $height .
 		 "\n</td>\n<td>\n" . $weight . "\n</td>\n<td>\n" . $team ."\n</td>\n<td>\n" . $coach_fname . ' ' . $coach_lname . "\n</td>\n</tr>";
		}
		$stmt->close();
		?>
	</table>
</div>

</body>
</html>
