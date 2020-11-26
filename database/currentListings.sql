-- create the tables for current (active) listings

DROP TABLE IF EXISTS `currentListings`;

CREATE TABLE `currentListings` (
  `listingId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateTimePosted` TIMESTAMP NOT NULL,
  `listingName` varchar(150) NOT NULL,
  `ownerId` int(10) unsigned NOT NULL,
  `price` varchar(20) NOT NULL,
  `isRenting` BOOLEAN NOT NULL,
  `paymentFrequency` varchar(50) NOT NULL,
  PRIMARY KEY (`listingId`)
);

-- insert data into the tables

INSERT INTO `currentListings` VALUES
  (null, CURRENT_TIMESTAMP, "Listing 1", 1, "$2000.00", 1, "monthly"),
  (null, CURRENT_TIMESTAMP, "Listing 2", 1, "$600,000.00", 0, "one time"),
  (null, CURRENT_TIMESTAMP, "Listing 3", 2, "$700,000.00", 0, "one time"),
  (null, CURRENT_TIMESTAMP, "Listing 4", 2, "$120,000.00", 1, "biweekly"),
  (null, CURRENT_TIMESTAMP, "Listing 5", 2, "$550.00", 1, "weekly");

