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

//Add to the Team Table
if(isset($_POST['add_team'])) {

	if(!($stmt = $mysqli->prepare("INSERT INTO team(city, name, division, season_win_pct) VALUES (?,?,?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ssss",$_POST['team_city'],$_POST['team_name'],$_POST['team_division'],$_POST['team_win_perct']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to team.";
		echo '<br><a class="return-btn" href="index.php">Return To Main Page</a>';
	}
}

//Update the Team Table
if(isset($_POST['update_team'])) {

	if(!($stmt = $mysqli->prepare("UPDATE `team` SET season_win_pct = ? WHERE city = ? AND name = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("sss",$_POST['team_win_perct'],$_POST['team_city'],$_POST['team_name']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " rows in team.";
		echo '<br><a class="return-btn" href="index.php">Return To Main Page</a>';
	}
}

//Add to the Coach Table
if(isset($_POST['add_coach'])) {

	if(!($stmt = $mysqli->prepare("INSERT INTO head_coach(first_name, last_name, career_win_pct, tid) VALUES (?,?,?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("sssi",$_POST['coach_first_name'],$_POST['coach_last_name'], $_POST['coach_win_perct'], $_POST['coach_team']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to head coach.";
		echo '<br><a class="return-btn" href="index.php">Return To Main Page</a>';
	}
}

//Add to the Player Table
if(isset($_POST['add_player'])) {

	if(!($stmt = $mysqli->prepare("INSERT INTO player(first_name, last_name, height, weight, tid, cid) VALUES (?,?,?,?,?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ssssii",$_POST['player_first_name'],$_POST['player_last_name'], $_POST['player_height'], $_POST['player_weight'], $_POST['player_team'], $_POST['player_coach']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to player.";
		echo '<br><a class="return-btn" href="index.php">Return To Main Page</a>';
	}
}

//Delete from the Player Table
if(isset($_POST['delete_player'])) {

	if(!($stmt = $mysqli->prepare("DELETE FROM `player` WHERE first_name = ? AND last_name = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ss",$_POST['player_first_name'],$_POST['player_last_name']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Deleted " . $stmt->affected_rows . " rows from player.";
		echo '<br><a class="return-btn" href="index.php">Return To Main Page</a>';
	}
}

//Add to the Position Table
if(isset($_POST['add_position'])) {

	if(!($stmt = $mysqli->prepare("INSERT INTO position (name) VALUES (?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("s",$_POST['position_name']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to position.";
		echo '<br><a class="return-btn" href="index.php">Return To Main Page</a>';
	}
}

//Add to the Player_Position Table
if(isset($_POST['add_player_position'])) {

	if(!($stmt = $mysqli->prepare("INSERT INTO player_position (pid, pos_id) VALUES (?, ?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ii",$_POST['player_name'],$_POST['position_name']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to player_position.";
		echo '<br><a class="return-btn" href="index.php">Return To Main Page</a>';
	}
}
