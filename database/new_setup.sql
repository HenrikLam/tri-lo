DROP TABLE IF EXISTS collectionListings;
DROP TABLE IF EXISTS groupInvitations;
DROP TABLE IF EXISTS groupMembers;
DROP TABLE IF EXISTS listingAmenities;
DROP TABLE IF EXISTS reports;
DROP TABLE IF EXISTS listingLocations;
DROP TABLE IF EXISTS collections;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS locations;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS states;
DROP TABLE IF EXISTS listings;

SHOW GLOBAL VARIABLES LIKE 'local_infile';
SET GLOBAL local_infile = 'ON';
SHOW GLOBAL VARIABLES LIKE 'local_infile';

CREATE TABLE users (
 userId int(10) unsigned NOT NULL AUTO_INCREMENT,
 firstName varchar(100) NOT NULL,
 lastName varchar(100) NOT NULL,
 username varchar(100) NOT NULL,
 password varchar(100) NOT NULL,
 email varchar(100) NOT NULL,
 PRIMARY KEY (userId)
);

CREATE TABLE groups (
  groupId int(10) unsigned NOT NULL AUTO_INCREMENT,
  groupName varchar(200) NOT NULL,
  groupDescription varchar(1000),
  groupOwnerId int(10) unsigned NOT NULL,
  PRIMARY KEY (groupId),
  FOREIGN KEY (groupOwnerId) REFERENCES users(userId)
);

CREATE TABLE listings (
  listingId int(10) unsigned NOT NULL AUTO_INCREMENT,
  listingName varchar(150) NOT NULL,
  ownerId int(10) unsigned NOT NULL,
  price varchar(20) NOT NULL,
  address varchar(1000) NOT NULL,
  city varchar(100) NOT NULL,
  state varchar(100) NOT NULL,
  zipcode varchar(15) NOT NULL,
  latitude FLOAT(9, 6) NOT NULL,
  longitude FLOAT(9, 6) NOT NULL,
  isRenting BOOLEAN NOT NULL,
  paymentFrequency varchar(50),
  bedrooms int(3),
  bathrooms FLOAT(4, 1),
  squareFeet int(5),
  dateTimePosted TIMESTAMP NOT NULL,
  status varchar(20) NOT NULL,
  PRIMARY KEY (listingId)
);

CREATE TABLE collections (
 collectionId int(10) unsigned NOT NULL AUTO_INCREMENT,
 collectionName varchar(200) NOT NULL,
 ownerId int(10) unsigned NOT NULL,
 PRIMARY KEY (collectionId),
 FOREIGN KEY (ownerId) REFERENCES users(userId)
);

CREATE TABLE reports (
 reportId int(10) unsigned NOT NULL AUTO_INCREMENT,
 userId int(10) unsigned NOT NULL,
 listingId int(10) unsigned NOT NULL,
 reasonForReport varchar(1000),
 PRIMARY KEY (reportId),
 FOREIGN KEY (userId) REFERENCES users(userId),
 FOREIGN KEY (listingId) REFERENCES listings(listingId)
);

CREATE TABLE collectionListings (
  collectionId int(10) unsigned NOT NULL,
  listingId int(10) unsigned NOT NULL,
  PRIMARY KEY (collectionId, listingId),
  FOREIGN KEY (collectionId) REFERENCES collections(collectionId),
  FOREIGN KEY (listingId) REFERENCES listings(listingId)
);

CREATE TABLE groupInvitations (
  groupId int(10) unsigned NOT NULL,
  invitedId int(10) unsigned NOT NULL,
  invitedById int(10) unsigned NOT NULL,
  PRIMARY KEY (groupId, invitedId, invitedById),
  FOREIGN KEY (groupId) REFERENCES groups(groupId),
  FOREIGN KEY (invitedId) REFERENCES users(userId),
  FOREIGN KEY (invitedById) REFERENCES users(userId)
);

CREATE TABLE groupMembers (
  groupId int(10) unsigned NOT NULL,
  memberId int(10) unsigned NOT NULL,
  PRIMARY KEY (groupId, memberId),
  FOREIGN KEY (groupId) REFERENCES groups(groupId),
  FOREIGN KEY (memberId) REFERENCES users(userId)
);

CREATE TABLE listingAmenities (
  listingId int(10) unsigned NOT NULL,
  amenity varchar(500) NOT NULL,
  amenityValue varchar(500) NOT NULL,
  FOREIGN KEY (listingId) REFERENCES listings(listingId)
);

CREATE TABLE states (
  name VARCHAR(32) NOT NULL,
  abbrev CHAR(3) NOT NULL
);

CREATE TABLE images (
  imageId int(10) unsigned NOT NULL AUTO_INCREMENT,
  listingId int(10) unsigned NOT NULL,
  link varchar(256) NOT NULL,
  PRIMARY KEY (imageId),
  FOREIGN KEY (listingId) REFERENCES listings(listingId)
);

SET GLOBAL local_infile = 'ON';

LOAD DATA INFILE '..\\..\\htdocs\\tri-lo\\database\\listings.csv' INTO TABLE listings
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n' (listingId,address,city,state,zipcode,latitude,longitude,price,bathrooms,bedrooms,squareFeet,isRenting,paymentFrequency,status,ownerId,dateTimePosted,listingName);

LOAD DATA INFILE '..\\..\\htdocs\\tri-lo\\database\\amenities.csv' INTO TABLE listingAmenities
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n' (listingId, amenity, amenityValue);

LOAD DATA INFILE '..\\..\\htdocs\\tri-lo\\database\\states.csv' INTO TABLE states
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n' (abbrev, name);

LOAD DATA INFILE '..\\..\\htdocs\\tri-lo\\database\\images.csv' INTO TABLE images
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n' (imageId, listingId, link);

INSERT INTO users VALUES 
(1, 'Land', 'Lord', 'lordl1', 'Password123', 'lordl1@rpi.edu'),
(2, 'Land', 'Lord', 'lordl2', 'Password123', 'lordl2@rpi.edu'),
(3, 'Land', 'Lord', 'lordl3', 'Password123', 'lordl3@rpi.edu'),
(4, 'RealEstate', 'Agent', 'agentr', 'Password123', 'agentr@rpi.edu'),
(5, 'Basic', 'User', 'username', 'Password123', 'user@rpi.edu'),
(6, 'Joe', 'Biden', 'bidenj', 'Password123', 'bidenj@rpi.edu'),
(7, 'Donald', 'Trump', 'trumpd', 'Password123', 'trumpd@rpi.edu'),
(8, 'Hillary', 'Clinton', 'clinth', 'Password123', 'clinth@rpi.edu'),
(9, 'Bernie', 'Sanders', 'sandeb', 'Password123', 'sandeb@rpi.edu'),
(10, 'John', 'Smith', 'smithj', 'Password123', 'smithj@rpi.edu'),
(11, 'Beth', 'Smith', 'smithb', 'Password123', 'smithb@rpi.edu'),
(12, 'Samantha', 'Cross', 'crosss', 'Password123', 'crosss@rpi.edu');

INSERT INTO `groups` VALUES
(1, 'Group A', 'Looking for a cute apartment', 5),
(2, 'Group B', 'Delete Me', 5),
(3, 'Group C', 'User Invited', 10),
(4, 'Group D', 'Other', 12);

INSERT INTO `groupMembers` VALUES 
(1, 5),
(1, 6),
(1, 7),
(2, 5),
(2, 10),
(3, 10),
(3, 11),
(3, 12),
(4, 11),
(4, 12);

INSERT INTO `groupInvitations` VALUES 
(1, 8, 5),
(1, 9, 5),
(2, 9, 12),
(3, 5, 10);

INSERT INTO `collections` VALUES
(1, "Big Bookmark", 5),
(2, "Empty", 5),
(3, "Favorites 1", 5),
(4, "Favorites 2", 5),
(5, "Favorites 3", 5);

INSERT INTO `collectionListings` VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(3, 5),
(3, 11),
(3, 27),
(4, 8),
(4, 9),
(4, 44),
(5, 1),
(5, 50),
(5, 51);

-- Alternative: mysqlimport --local --verbose --delete --columns=id,name,alt_name,iata,icao,callsign,country,active --fields-terminated-by=\, --fields-optionally-enclosed-by=\" --lines-terminated-by=\n --user=Cony -p openflight "c:\ProgramData\MySQL\MySQL Server 8.0\Uploads\airlines.csv"