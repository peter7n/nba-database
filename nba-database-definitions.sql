###########################################
# Authors: Peter Nguyen, Louise McGuire
# Date: 3/13/16
# CS 340-400
# Final Project
###########################################


-- season_win_pct is represented as .xxx
-- the combination of city and team name must be unique

CREATE TABLE `team` (
  `id` int AUTO_INCREMENT NOT NULL,
  `city` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `season_win_pct` decimal(3,3),
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_name` (`city`, `name`)
) ENGINE=InnoDB;


CREATE TABLE `head_coach` (
  `id` int AUTO_INCREMENT NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `career_win_pct` decimal(3,3),
  `tid` int,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`tid`) REFERENCES `team` (`id`)
) ENGINE=InnoDB;


CREATE TABLE `player` (
  `id` int AUTO_INCREMENT NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `height` int,
  `weight` int,
  `tid` int,
  `cid` int,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`tid`) REFERENCES `team` (`id`),
  FOREIGN KEY (`cid`) REFERENCES `head_coach` (`id`)
) ENGINE=InnoDB;


CREATE TABLE `position` (
  `id` int AUTO_INCREMENT NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


CREATE TABLE `player_position` (
  `pid` int NOT NULL,
  `pos_id` int NOT NULL,
  PRIMARY KEY(`pid`, `pos_id`),
  FOREIGN KEY (`pid`) REFERENCES `player` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`pos_id`) REFERENCES `position` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;
