-- create the tables for the relationship between collection and listings

DROP TABLE IF EXISTS `collectionListings`;

CREATE TABLE `collectionListings` (
  `collectionId` int(10) unsigned NOT NULL,
  `listingId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`collectionId`, `listingId`),
  FOREIGN KEY (`collectionId`) REFERENCES `collections`(`collectionId`),
  FOREIGN KEY (`listingId`) REFERENCES `currentListings`(`listingId`)
);

-- insert data into the table

INSERT INTO `collectionListings` VALUES
  (1, 1),
  (1, 2),
  (1, 4),
  (2, 1),
  (2, 3),
  (3, 5);

