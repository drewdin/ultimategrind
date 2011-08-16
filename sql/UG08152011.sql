#
# Encoding: Unicode (UTF-8)
#


DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `display_values`;
DROP TABLE IF EXISTS `logins`;
DROP TABLE IF EXISTS `questions`;
DROP TABLE IF EXISTS `responses`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `values`;
DROP TABLE IF EXISTS `warmups`;


CREATE TABLE `categories` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` text NOT NULL,
  `order` tinyint(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


CREATE TABLE `display_values` (
  `display_value_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `display_value` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`display_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;


CREATE TABLE `logins` (
  `login_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) DEFAULT NULL,
  `browser` varchar(128) DEFAULT NULL,
  `login` timestamp NULL DEFAULT NULL,
  `logout` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


CREATE TABLE `questions` (
  `question_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `question` varchar(128) NOT NULL DEFAULT '',
  `order` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;


CREATE TABLE `responses` (
  `response_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `question_id` int(11) unsigned NOT NULL,
  `response` tinytext NOT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`response_id`)
) ENGINE=InnoDB AUTO_INCREMENT=648 DEFAULT CHARSET=latin1;


CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(40) NOT NULL,
  `email` tinytext,
  `access` varchar(15) DEFAULT 'user',
  `firstName` tinytext,
  `lastName` tinytext,
  `modified` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


CREATE TABLE `values` (
  `value_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) unsigned DEFAULT NULL,
  `type` int(11) unsigned DEFAULT NULL,
  `value` int(11) unsigned DEFAULT NULL,
  `display_value_id` int(11) unsigned DEFAULT NULL,
  `order` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;


CREATE TABLE `warmups` (
  `warmup_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT '0',
  `warm_up` int(11) unsigned DEFAULT '0',
  `plyo` int(11) unsigned DEFAULT '0',
  `stability` int(11) unsigned DEFAULT '0',
  `strength` int(11) unsigned DEFAULT '0',
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`warmup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;




SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `categories` WRITE;
INSERT INTO `categories` (`category_id`, `category`, `order`) VALUES (1, 'Overhead Squat Test - 20 Reps for each view', 1);
INSERT INTO `categories` (`category_id`, `category`, `order`) VALUES (2, 'Modified Push-Ups in 2 minutes (Chin on the ground, straight arm mod plank)', 2);
INSERT INTO `categories` (`category_id`, `category`, `order`) VALUES (3, 'Crunches in 2 minutes (Shoulders on ground->forearms on thighs)', 3);
INSERT INTO `categories` (`category_id`, `category`, `order`) VALUES (4, 'Burpees in 2 minutes (standing->strainght arm plank->standing)', 4);
UNLOCK TABLES;


LOCK TABLES `display_values` WRITE;
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (1, 'yes');
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (2, 'no');
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (3, 'left');
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (4, 'right');
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (5, 'lean forward');
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (6, 'back arched');
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (7, 'down back');
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (8, 'rolling forward');
INSERT INTO `display_values` (`display_value_id`, `display_value`) VALUES (9, 'none');
UNLOCK TABLES;


LOCK TABLES `logins` WRITE;
UNLOCK TABLES;


LOCK TABLES `questions` WRITE;
INSERT INTO `questions` (`question_id`, `category_id`, `question`, `order`) VALUES (1, 1, 'Front View - feet turn out?', 1);
INSERT INTO `questions` (`question_id`, `category_id`, `question`, `order`) VALUES (2, 1, 'Front View - knees go in?', 2);
INSERT INTO `questions` (`question_id`, `category_id`, `question`, `order`) VALUES (3, 1, 'Front View - did weight shift?', 3);
INSERT INTO `questions` (`question_id`, `category_id`, `question`, `order`) VALUES (4, 1, 'Side View - lean forward or back arched?', 4);
INSERT INTO `questions` (`question_id`, `category_id`, `question`, `order`) VALUES (6, 1, 'Modified - using mat under your heels, did lean or arch go away?', 5);
INSERT INTO `questions` (`question_id`, `category_id`, `question`, `order`) VALUES (71, 2, 'Number of Pushups', 1);
INSERT INTO `questions` (`question_id`, `category_id`, `question`, `order`) VALUES (72, 3, 'Number of Crunches', 1);
INSERT INTO `questions` (`question_id`, `category_id`, `question`, `order`) VALUES (73, 4, 'Number of Burpees', 1);
UNLOCK TABLES;


LOCK TABLES `responses` WRITE;
UNLOCK TABLES;


LOCK TABLES `users` WRITE;
UNLOCK TABLES;


LOCK TABLES `values` WRITE;
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (19, 1, 1, 1, 1, 1);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (20, 1, 1, 9, 2, 2);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (21, 2, 1, 5, 1, 1);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (22, 2, 1, 9, 2, 2);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (23, 3, 1, 4, 3, 1);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (24, 3, 1, 10, 4, 2);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (25, 3, 1, 9, 9, 3);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (26, 4, 1, 2, 5, 1);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (27, 4, 1, 2, 6, 2);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (28, 4, 1, 9, 9, 3);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (29, 6, 1, 1, 1, 1);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (30, 6, 1, 2, 2, 2);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (31, 71, 2, 0, 9, 1);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (32, 72, 2, 0, 9, 1);
INSERT INTO `values` (`value_id`, `question_id`, `type`, `value`, `display_value_id`, `order`) VALUES (33, 73, 2, 0, 9, 1);
UNLOCK TABLES;


LOCK TABLES `warmups` WRITE;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = 1;


