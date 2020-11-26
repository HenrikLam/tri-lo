-- create the tables for our users

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
 `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `firstName` varchar(100) NOT NULL,
 `lastName` varchar(100) NOT NULL,
 `username` varchar(100) NOT NULL,
 `password` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 PRIMARY KEY (`userId`)
);

-- insert data into the tables

INSERT INTO `users` VALUES
  (null, "Joe", "Schmoe", "schmoe", "joesPassword_123", "schmoe@rpi.edu"),
  (null, "Sally", "Anderson", "anders", "myPassword_!!", "anders@rpi.edu");

