DROP TABLE IF EXISTS collectionListings;
DROP TABLE IF EXISTS userBookmarks;
DROP TABLE IF EXISTS groupInvitations;
DROP TABLE IF EXISTS groupMembers;
DROP TABLE IF EXISTS listingAmenities;
DROP TABLE IF EXISTS reports;
DROP TABLE IF EXISTS collections;
DROP TABLE IF EXISTS listings;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS locations;
DROP TABLE IF EXISTS users;

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
  dateTimePosted TIMESTAMP NOT NULL,
  status varchar(20) NOT NULL,
  listingName varchar(150) NOT NULL,
  ownerId int(10) unsigned NOT NULL,
  price varchar(20) NOT NULL,
  isRenting BOOLEAN NOT NULL,
  paymentFrequency varchar(50) NOT NULL,
  longitude varchar(15),
  latitude varchar(15),
  livingArea varchar(50),
  addressLine varchar(1000),
  city varchar(500),
  state varchar(500),
  zipcode varchar(15),
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
  FOREIGN KEY (listingId) REFERENCES currentListings(listingId)
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
  PRIMARY KEY (listingId, amenity),
  FOREIGN KEY (listingId) REFERENCES listings(listingId)
);

CREATE TABLE userBookmarks (
  userId int(10) unsigned NOT NULL,
  listingId int(10) unsigned NOT NULL,
  PRIMARY KEY (userId, listingId),
  FOREIGN KEY (userId) REFERENCES users(userId),
  FOREIGN KEY (listingId) REFERENCES listings(listingId)
);