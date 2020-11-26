-- create the tables for the relationship between listing and amenities

DROP TABLE IF EXISTS `listingAmenities`;

CREATE TABLE `listingAmenities` (
  `listingId` int(10) unsigned NOT NULL,
  `amenityId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`listingId`, `amenityId`),
  FOREIGN KEY (`listingId`) REFERENCES `currentListings`(`listingId`),
  FOREIGN KEY (`amenityId`) REFERENCES `amenities`(`amenityId`)
);

-- insert data into the table

INSERT INTO `listingAmenities` VALUES
  (1, 1),
  (1, 4),
  (2, 2),
  (2, 3),
  (2, 4);

