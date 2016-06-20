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
	<h2>NBA Coaches Team Season Win Percentage</h2>
	<table>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Team Name</th>
			<th>Season Win Pct</th>
		</tr>
		<?php
		if(!($stmt = $mysqli->prepare("SELECT head_coach.first_name, head_coach.last_name, team.name, team.season_win_pct FROM `head_coach`
		INNER JOIN `team` ON team.id = head_coach.tid
		WHERE team.season_win_pct >= ?"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!($stmt->bind_param("s",$_POST['team_win_perct']))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}

		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($first_name, $last_name, $team, $team_win)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		while($stmt->fetch()){
			echo "<tr>\n<td>\n" . $first_name . "\n</td>\n<td>\n" . $last_name . "\n</td>\n<td>\n" . $team .
 		 "\n</td>\n<td>\n" . $team_win . "\n</td>\n</tr>";
		}
		$stmt->close();
		?>
	</table>
</div>

</body>
</html>
