-- create the tables for users' groups

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `groupId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupName` varchar(200) NOT NULL,
  `groupDescription` varchar(1000),
  `groupOwnerId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`groupId`),
  FOREIGN KEY (`groupOwnerId`) REFERENCES `users`(`userId`)
);

-- insert data into the table

INSERT INTO `groups` VALUES
  (null, "Senior Year Housing Group", "Looking for places to live next year", 1),
  (null, "Post Graduation Roomies", "Roommates for post grad", 1),
  (null, "Winter Break Vacation", null, 2);

