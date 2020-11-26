-- create the tables for all amenities

DROP TABLE IF EXISTS `amenities`;

CREATE TABLE `amenities` (
  `amenityId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amenity` varchar(500),
  `value` varchar(500),
  PRIMARY KEY (`amenityId`)
);

-- insert data into the table

INSERT INTO `amenities` VALUES
  (null, "washing machine", "2"),
  (null, "pets allowed", "no"),
  (null, "smoking allowed", "yes"),
  (null, "bedrooms", "3");

