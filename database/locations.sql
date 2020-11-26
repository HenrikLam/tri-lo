-- create the tables for all locations

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `locationId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `addressLine1` varchar(1000),
  `addressLine2` varchar(1000),
  `city` varchar(100),
  `state` varchar(100),
  `zipcode` varchar(15),
  PRIMARY KEY (`locationId`)
);

-- insert data into the tables

INSERT INTO `locations` VALUES
  (null, "123 Apple Street", null, "Troy", "New York", "12180"),
  (null, null, null, "Troy", "New York", null),
  (null, "456 Peanut Avenue", "Apt 4B", "Troy", "New York", "12180");

