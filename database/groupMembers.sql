-- create the tables for relationship between users and the groups they are in

DROP TABLE IF EXISTS `groupMembers`;

CREATE TABLE `groupMembers` (
  `groupId` int(10) unsigned NOT NULL,
  `memberId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`groupId`, `memberId`),
  FOREIGN KEY (`groupId`) REFERENCES `groups`(`groupId`),
  FOREIGN KEY (`memberId`) REFERENCES `users`(`userId`)
);

-- insert data into the table

INSERT INTO `groupMembers` VALUES
  (1, 1),
  (1, 2),
  (2, 1),
  (3, 1);

