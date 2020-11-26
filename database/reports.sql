-- create the tables for our users

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
 `reportId` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `userId` int(10) unsigned NOT NULL,
 `listingId` int(10) unsigned NOT NULL,
 `reasonForReport` varchar(1000),
 PRIMARY KEY (`reportId`),
 FOREIGN KEY (`userId`) REFERENCES `users`(`userId`),
 FOREIGN KEY (`listingId`) REFERENCES `currentListings`(`listingId`)
);

-- insert data into the tables

INSERT INTO `reports` VALUES
  (null, 2, 1, "False information"),
  (null, 2, 2, "This person does not own this property"),
  (null, 1, 4, null);

