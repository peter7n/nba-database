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
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<!-- NBA Teams -->
	<div>
		<h2>NBA Teams</h2>
		<table>
			<tr>
				<th>Name</th>
				<th>City</th>
				<th>Division</th>
				<th>Season Win Percentage</th>
			</tr>

			<?php
			if(!($stmt = $mysqli->prepare("SELECT team.name, team.city, team.division, team.season_win_pct FROM team"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}

			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($name, $city, $division, $win_percentage)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
			 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $city . "\n</td>\n<td>\n" . $division . "\n</td>\n<td>\n" . $win_percentage. "\n</td>\n</tr>";
			}
			$stmt->close();
			?>
		</table>
	</div>

	<!-- Add Teams -->
	<h3>Add New NBA Team</h3>
	<div>
			<form method="post" action="add_table.php">
				<p><input type="text" placeholder="Team Name" name="team_name" /></p>
				<p><input type="text" placeholder="City" name="team_city" /></p>
				<p><input type="text" placeholder="Division" name="team_division" /></p>
				<p><input type="text" placeholder="Season Win Percentage" name="team_win_perct" /></p>
				<p><input type="submit" name="add_team"/></p>
			</form>
	</div>

	<!-- Update Team Season Win Percentage -->
	<h3>Update Season Win Percentage</h3>
	<div>
			<form method="post" action="add_table.php">
				<p><input type="text" placeholder="Team Name" name="team_name" /></p>
				<p><input type="text" placeholder="City" name="team_city" /></p>
				<p><input type="text" placeholder="New Season Win Percentage" name="team_win_perct" /></p>
				<p><input type="submit" name="update_team"/></p>
			</form>
	</div>

	<div class="section-divider"></div>

	<!-- NBA Head Coaches -->
	<div>
		<h2>NBA Head Coaches</h2>
		<table>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Team</th>
				<th>Career Win Percentage</th>

			</tr>

			<?php
			if(!($stmt = $mysqli->prepare("SELECT head_coach.first_name, head_coach.last_name, team.name, head_coach.career_win_pct FROM head_coach INNER JOIN team on head_coach.tid = team.id"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}

			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($first_name, $last_name, $team, $coach_win_percentage)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
				echo "<tr>\n<td>\n" . $first_name . "\n</td>\n<td>\n" . $last_name . "\n</td>\n<td>\n" . $team . "\n</td>\n<td>\n" . $coach_win_percentage. "\n</td>\n</tr>";
			}

			$stmt->close();
			?>
		</table>
	</div>

	<!-- Add Head Coach -->
	<h3>Add New Head Coach</h3>
	<div>
			<form method="post" action="add_table.php">
				<p><input type="text" placeholder="First Name" name="coach_first_name" /></p>
				<p><input type="text" placeholder="Last Name" name="coach_last_name" /></p>
				<p><input type="text" placeholder="Career Win Percentage" name="coach_win_perct" /></p>
				<select name="coach_team">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM team"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $name)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<p><input type="submit" name="add_coach"/></p>
			</form>
	</div>

	<!-- Filter Head Coach -->
	<h3>Filter Head Coach By Team Season Win Percentage</h3>
	<div>
			<form method="post" action="filter_coach.php">
				<p><input type="text" placeholder="Team Win Percentage Is At Least" name="team_win_perct" /></p>
				<p><input type="submit" name="filter_coach"/></p>
			</form>
	</div>

	<div class="section-divider"></div>

	<!-- NBA Players -->
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
			if(!($stmt = $mysqli->prepare("SELECT player.first_name, player.last_name, player.height, player.weight, team.name, head_coach.first_name, head_coach.last_name
										   FROM player INNER JOIN team on player.tid = team.id
										   INNER JOIN head_coach on player.cid = head_coach.id"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
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

	<!-- Add Player -->
	<h3>Add New Player</h3>
	<div>
		<form method="post" action="add_table.php">
			<p><input type="text" placeholder="First Name" name="player_first_name" /></p>
			<p><input type="text" placeholder="Last Name" name="player_last_name" /></p>
			<p><input type="text" placeholder="Height" name="player_height" /></p>
			<p><input type="text" placeholder="Weight" name="player_weight" /></p>
			<select name="player_team">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, name FROM team"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($id, $tname)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $id . ' "> ' . $tname . '</option>\n';
				}
				$stmt->close();
				?>
			</select><br>
			<select name="player_coach">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, first_name, last_name FROM head_coach"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($id, $fname, $lname)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $id . ' "> ' . $fname . ' ' . $lname . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<p><input type="submit" name="add_player"/></p>
		</form>
	</div>

	<!-- Delete Player -->
	<h3>Delete Player</h3>
	<div>
		<form method="post" action="add_table.php">
			<p><input type="text" placeholder="First Name" name="player_first_name" /></p>
			<p><input type="text" placeholder="Last Name" name="player_last_name" /></p>
			<p><input type="submit" name="delete_player"/></p>
		</form>
	</div>

	<!-- Filter Players by Position -->
	<div>
		<form method="post" action="filter_player.php">
			<h3>Filter By Position</h3>
				<select name="Position">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM position"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id, $pname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
			<input type="submit" value="Run Filter" />
		</form>
	</div>


	<div class="section-divider"></div>


	<!-- NBA Position -->
	<div>
		<h2>NBA Positions</h2>
		<table>
			<tr>
				<th>Name</th>
			</tr>

			<?php
			if(!($stmt = $mysqli->prepare("SELECT name FROM position"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}

			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($name)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
			 echo "<tr>\n<td>\n" . $name . "\n</td>\n</tr>";
			}
			$stmt->close();
			?>
		</table>
	</div>

	<!-- Add Position -->
	<h3>Add New NBA Position</h3>
	<div>
		<form method="post" action="add_table.php">
			<p><input type="text" placeholder="Position Name" name="position_name" /></p>
			<p><input type="submit" name="add_position"/></p>
		</form>
	</div>

	<div class="section-divider"></div>

	<!-- Players & Positions -->
	<div>
		<h2>Players &amp; Positions</h2>
		<table>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Position</th>
			</tr>

			<?php
			if(!($stmt = $mysqli->prepare("SELECT player.first_name, player.last_name, position.name
										   FROM player_position INNER JOIN player on player.id = player_position.pid
										   INNER JOIN position on position.id = player_position.pos_id"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}

			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($first_name, $last_name, $position)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
				echo "<tr>\n<td>\n" . $first_name . "\n</td>\n<td>\n" . $last_name . "\n</td>\n<td>\n" . $position . "\n</td>\n</tr>";
			}

			$stmt->close();
			?>
		</table>
	</div>

	<!-- Assign Position to Player -->
	<h3>Assign Positions to Players</h3>
	<div>
		<form method="post" action="add_table.php">
			<select name="player_name">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, first_name, last_name FROM player"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($id, $fname, $lname)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $id . ' "> ' . $fname . ' ' . $lname . '</option>\n';
				}
				$stmt->close();
				?>
			</select><br>
			<select name="position_name">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, name FROM position"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($id, $name)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
				}
				$stmt->close();
				?>
			</select><br>
			<p><input type="submit" name="add_player_position"/></p>
		</form>
	</div>
	<div class="section-divider"></div>
</body>
</html>
