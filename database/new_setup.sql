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
LINES TERMINATED BY '\n' (listingId,address,city,state,zipcode,latitude,longitude,price,bathrooms,bedrooms,squareFeet,isRenting,paymentFrequency,status,ownerId,dateTimePosted);

LOAD DATA INFILE '..\\..\\htdocs\\tri-lo\\database\\amenities.csv' INTO TABLE listingAmenities
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n' (listingId, amenity, amenityValue);

LOAD DATA INFILE '..\\..\\htdocs\\tri-lo\\database\\states.csv' INTO TABLE states
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n' (abbrev, name);

LOAD DATA INFILE '..\\..\\htdocs\\tri-lo\\database\\images.csv' INTO TABLE images
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n' (imageId, listingId, link);

INSERT INTO users
VALUES (1, 'Javier', 'Portorreal', 'portoj', 'Password123', 'portoj@rpi.edu');

-- Alternative: mysqlimport --local --verbose --delete --columns=id,name,alt_name,iata,icao,callsign,country,active --fields-terminated-by=\, --fields-optionally-enclosed-by=\" --lines-terminated-by=\n --user=Cony -p openflight "c:\ProgramData\MySQL\MySQL Server 8.0\Uploads\airlines.csv"