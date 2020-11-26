-- create the tables for collections

DROP TABLE IF EXISTS `collections`;

CREATE TABLE `collections` (
 `collectionId` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `collectionName` varchar(200) NOT NULL,
 `ownerId` int(10) unsigned NOT NULL,
 PRIMARY KEY (`collectionId`),
 FOREIGN KEY (`ownerId`) REFERENCES `users`(`userId`)
);

-- insert data into the table

INSERT INTO `collections` VALUES
  (null, "Joe's Dream Houses", 1),
  (null, "Joe's Senior Year Housing", 1),
  (null, "Sally's Vacation Houses", 2);

