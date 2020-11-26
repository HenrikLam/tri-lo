-- create the tables for relationship between users and the groups they were invited to

DROP TABLE IF EXISTS `groupInvitations`;

CREATE TABLE `groupInvitations` (
  `groupId` int(10) unsigned NOT NULL,
  `invitedId` int(10) unsigned NOT NULL,
  `invitedById` int(10) unsigned NOT NULL,
  PRIMARY KEY (`groupId`, `invitedId`, `invitedById`),
  FOREIGN KEY (`groupId`) REFERENCES `groups`(`groupId`),
  FOREIGN KEY (`invitedId`) REFERENCES `users`(`userId`),
  FOREIGN KEY (`invitedById`) REFERENCES `users`(`userId`)
);

-- insert data into the table

INSERT INTO `groupInvitations` VALUES
  (1, 2, 1),
  (2, 2, 1),
  (3, 1, 2);

