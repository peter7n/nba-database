###########################################
# Authors: Peter Nguyen, Louise McGuire
# Date: 3/13/16
# CS 340-400
# Final Project
###########################################

-- Insert queries

INSERT INTO `team` (city, name, division, season_win_pct)
VALUES ([city],[name],[division],[season win percentage]);

INSERT INTO `head_coach` (first_name, last_name, career_win_pct, tid)
VALUES ([first name],[last name],[career win percentage],(SELECT id FROM `team` WHERE city = [city] AND name = [name]));

INSERT INTO `player` (first_name, last_name, height, weight, tid, cid)
VALUES ([first name],[last name],[height],[weight],(SELECT id FROM `team` WHERE city = [city] AND name = [name]),(SELECT id FROM `head_coach` WHERE first_name = [first name] AND last_name = [last name]));

INSERT INTO `position` (name)
VALUES ([position name]);

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = [first name] AND last_name = [last name]),(SELECT id FROM `position` WHERE name = [position name]));


-- Update queries

UPDATE `team`
SET season_win_pct = [season win percentage]
WHERE city = [city name] AND name = [team name];


-- Delete queries
DELETE FROM `player`
WHERE first_name = [first name] AND last_name = [last name];


-- Select queries

-- Select every player who plays a particular position
-- (Uses tables: player, position, player_position, team, head_coach)
SELECT player.first_name, player.last_name, player.height, player.weight, team.name, head_coach.first_name, head_coach.last_name FROM `player`
INNER JOIN `player_position` ON player_position.pid = player.id
INNER JOIN `position` ON position.id = player_position.pos_id
INNER JOIN `team` ON team.id = player.tid
INNER JOIN `head_coach` ON head_coach.id = player.cid
WHERE position.name = [position id];

-- Select every coach whose team has a win percentage greater than specified
-- (Uses tables: team, head_coach)
SELECT head_coach.first_name, head_coach.last_name, team.name, team.season_win_pct FROM `head_coach`
INNER JOIN `team` ON team.id = head_coach.tid
WHERE team.season_win_pct >= [win percentage];


####################################################
-- Insert sample data

INSERT INTO `team` (city, name, division, season_win_pct)
VALUES ("Los Angeles","Lakers","Pacific",.200);

INSERT INTO `team` (city, name, division, season_win_pct)
VALUES ("Boston","Celtics","Atlantic",.550);

INSERT INTO `team` (city, name, division, season_win_pct)
VALUES ("Golden State","Warriors","Pacific",.900);


INSERT INTO `head_coach` (first_name, last_name, career_win_pct, tid)
VALUES ("Byron","Scott",.400,(SELECT id FROM `team` WHERE city = "Los Angeles" AND name = "Lakers"));

INSERT INTO `head_coach` (first_name, last_name, career_win_pct, tid)
VALUES ("Brad","Stevens",.500,(SELECT id FROM `team` WHERE city = "Boston" AND name = "Celtics"));

INSERT INTO `head_coach` (first_name, last_name, career_win_pct, tid)
VALUES ("Steve","Kerr",.800,(SELECT id FROM `team` WHERE city = "Golden State" AND name = "Warriors"));


INSERT INTO `player` (first_name, last_name, height, weight, tid, cid)
VALUES ("Kobe","Bryant",78,212,(SELECT id FROM `team` WHERE city = "Los Angeles" AND name = "Lakers"),(SELECT id FROM `head_coach` WHERE first_name = "Byron" AND last_name = "Scott"));

INSERT INTO `player` (first_name, last_name, height, weight, tid, cid)
VALUES ("D'Angelo","Russell",77,195,(SELECT id FROM `team` WHERE city = "Los Angeles" AND name = "Lakers"),(SELECT id FROM `head_coach` WHERE first_name = "Byron" AND last_name = "Scott"));

INSERT INTO `player` (first_name, last_name, height, weight, tid, cid)
VALUES ("Isaiah","Thomas",69,185,(SELECT id FROM `team` WHERE city = "Boston" AND name = "Celtics"),(SELECT id FROM `head_coach` WHERE first_name = "Brad" AND last_name = "Stevens"));

INSERT INTO `player` (first_name, last_name, height, weight, tid, cid)
VALUES ("Jae","Crowder",77,235,(SELECT id FROM `team` WHERE city = "Boston" AND name = "Celtics"),(SELECT id FROM `head_coach` WHERE first_name = "Brad" AND last_name = "Stevens"));

INSERT INTO `player` (first_name, last_name, height, weight, tid, cid)
VALUES ("Stephen","Curry",75,190,(SELECT id FROM `team` WHERE city = "Golden State" AND name = "Warriors"),(SELECT id FROM `head_coach` WHERE first_name = "Steve" AND last_name = "Kerr"));

INSERT INTO `player` (first_name, last_name, height, weight, tid, cid)
VALUES ("Klay","Thompson",78,215,(SELECT id FROM `team` WHERE city = "Golden State" AND name = "Warriors"),(SELECT id FROM `head_coach` WHERE first_name = "Steve" AND last_name = "Kerr"));


INSERT INTO `position` (name)
VALUES ("point guard");

INSERT INTO `position` (name)
VALUES ("shooting guard");

INSERT INTO `position` (name)
VALUES ("small forward");

INSERT INTO `position` (name)
VALUES ("power forward");

INSERT INTO `position` (name)
VALUES ("center");


INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "Kobe" AND last_name = "Bryant"),(SELECT id FROM `position` WHERE name = "shooting guard"));

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "Kobe" AND last_name = "Bryant"),(SELECT id FROM `position` WHERE name = "small forward"));

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "D'Angelo" AND last_name = "Russell"),(SELECT id FROM `position` WHERE name = "point guard"));

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "Isaiah" AND last_name = "Thomas"),(SELECT id FROM `position` WHERE name = "point guard"));

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "Jae" AND last_name = "Crowder"),(SELECT id FROM `position` WHERE name = "small forward"));

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "Jae" AND last_name = "Crowder"),(SELECT id FROM `position` WHERE name = "power forward"));

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "Stephen" AND last_name = "Curry"),(SELECT id FROM `position` WHERE name = "point guard"));

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "Klay" AND last_name = "Thompson"),(SELECT id FROM `position` WHERE name = "shooting guard"));

INSERT INTO `player_position` (pid, pos_id)
VALUES ((SELECT id FROM `player` WHERE first_name = "Klay" AND last_name = "Thompson"),(SELECT id FROM `position` WHERE name = "small forward"));
