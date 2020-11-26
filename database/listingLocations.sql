-- create the tables for the relationship between listing and location

DROP TABLE IF EXISTS `listingLocations`;

CREATE TABLE `listingLocations` (
  `listingId` int(10) unsigned NOT NULL,
  `locationId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`listingId`, `locationId`),
  FOREIGN KEY (`listingId`) REFERENCES `currentListings`(`listingId`),
  FOREIGN KEY (`locationId`) REFERENCES `locations`(`locationId`)
);

-- insert data into the table

INSERT INTO `listingLocations` VALUES
  (1, 1),
  (2, 3);

