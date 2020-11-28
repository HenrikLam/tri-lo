DROP DATABASE markets;
CREATE SCHEMA markets;
USE markets;

FLUSH privileges;

SHOW GLOBAL VARIABLES LIKE 'local_infile';
SET GLOBAL local_infile = 'ON';
SHOW GLOBAL VARIABLES LIKE 'local_infile';

USE markets;

CREATE TABLE `farmers` (
  `id` INT NOT NULL PRIMARY KEY,
  `name` VARCHAR(128) DEFAULT NULL,
  `website` VARCHAR(255) DEFAULT NULL,
  `facebook` VARCHAR(255) DEFAULT NULL,
  `twitter` VARCHAR(128) DEFAULT NULL,
  `youtube` VARCHAR(128) DEFAULT NULL,
  `street` VARCHAR(255) DEFAULT NULL,
  `city` VARCHAR(128) DEFAULT NULL,
  `county` VARCHAR(32) DEFAULT NULL,
  `state` VARCHAR(32) DEFAULT NULL,
  `zip` CHAR(5) DEFAULT NULL,
  `xcoord` FLOAT(9, 6) DEFAULT NULL,
  `ycoord` FLOAT(9, 6) DEFAULT NULL
);

CREATE TABLE `payments` (
  `id` INT NOT NULL PRIMARY KEY,
  `credit` TINYINT(1) DEFAULT false,
  `wic` TINYINT(1) DEFAULT false,
  `wiccash` TINYINT(1) DEFAULT false,
  `sfmnp` TINYINT(1) DEFAULT false,
  `snap` TINYINT(1) DEFAULT false
);

CREATE TABLE `products` (
  `id` INT NOT NULL PRIMARY KEY,
  `organic` TINYINT(1) DEFAULT false,
  `bakedgoods` TINYINT(1) DEFAULT false,
  `cheese` TINYINT(1) DEFAULT false,
  `crafts` TINYINT(1) DEFAULT false,
  `flowers` TINYINT(1) DEFAULT false,
  `eggs` TINYINT(1) DEFAULT false,
  `seafood` TINYINT(1) DEFAULT false,
  `herbs` TINYINT(1) DEFAULT false,
  `vegetables` TINYINT(1) DEFAULT false,
  `honey` TINYINT(1) DEFAULT false,
  `jams` TINYINT(1) DEFAULT false,
  `maple` TINYINT(1) DEFAULT false,
  `meat` TINYINT(1) DEFAULT false,
  `nursery` TINYINT(1) DEFAULT false,
  `nuts` TINYINT(1) DEFAULT false,
  `plants` TINYINT(1) DEFAULT false,
  `poultry` TINYINT(1) DEFAULT false,
  `prepared` TINYINT(1) DEFAULT false,
  `soap` TINYINT(1) DEFAULT false,
  `trees` TINYINT(1) DEFAULT false,
  `wine` TINYINT(1) DEFAULT false,
  `coffee` TINYINT(1) DEFAULT false,
  `beans` TINYINT(1) DEFAULT false,
  `fruits` TINYINT(1) DEFAULT false,
  `grains` TINYINT(1) DEFAULT false,
  `juices` TINYINT(1) DEFAULT false,
  `mushrooms` TINYINT(1) DEFAULT false,
  `petfood` TINYINT(1) DEFAULT false,
  `tofu` TINYINT(1) DEFAULT false,
  `wildharvested` TINYINT(1) DEFAULT false
);

CREATE TABLE `zipcodes` (
  `zip` CHAR(5) PRIMARY KEY,
  `xcoord` FLOAT(9, 6) NOT NULL,
  `ycoord` FLOAT(9, 6) NOT NULL,
  `city` VARCHAR(32) DEFAULT NULL,
  `state` VARCHAR(32) DEFAULT NULL,
  `county` VARCHAR(32) DEFAULT NULL  
);

CREATE TABLE `states` (
  `name` VARCHAR(32) NOT NULL,
  `abbrev` CHAR(3) DEFAULT NULL
);

SET GLOBAL local_infile = 'ON';

LOAD DATA INFILE 'C:\\ProgramData\\MySQL\\MySQL Server 8.0\\Uploads\\farmers.csv' INTO TABLE farmers
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n' (id, name, website, facebook, twitter, youtube, street, city, county, state, zip, @vxcoord, @vycoord)
SET xcoord = NULLIF(@vxcoord,''),
ycoord = NULLIF(@vycoord,'');

LOAD DATA INFILE 'C:\\ProgramData\\MySQL\\MySQL Server 8.0\\Uploads\\payments.csv' INTO TABLE payments
FIELDS TERMINATED BY ';' ENCLOSED BY '\"'
LINES TERMINATED BY '\n' (id, credit, wic, wiccash, sfmnp, snap);

LOAD DATA INFILE 'C:\\ProgramData\\MySQL\\MySQL Server 8.0\\Uploads\\products.csv' INTO TABLE products
FIELDS TERMINATED BY ';' ENCLOSED BY '\"'
LINES TERMINATED BY '\n' (id,organic,bakedgoods,cheese,crafts,flowers,eggs,seafood,herbs,vegetables,honey,jams,maple,meat,nursery,nuts,plants,poultry,prepared,soap,trees,wine,coffee,beans,fruits,grains,juices,mushrooms,petfood,tofu,wildharvested);

LOAD DATA INFILE 'C:\\ProgramData\\MySQL\\MySQL Server 8.0\\Uploads\\zips.csv' INTO TABLE zipcodes
FIELDS TERMINATED BY ',' ENCLOSED BY '\"'
LINES TERMINATED BY '\n' (zip, ycoord, xcoord, city, state, county)

LOAD DATA INFILE 'c:\\ProgramData\\MySQL\\MySQL Server 8.0\\Uploads\\states.csv' INTO TABLE states
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n' (abbrev, name)

-- Alternative: mysqlimport --local --verbose --delete --columns=id,name,alt_name,iata,icao,callsign,country,active --fields-terminated-by=\, --fields-optionally-enclosed-by=\" --lines-terminated-by=\n --user=Cony -p openflight "c:\ProgramData\MySQL\MySQL Server 8.0\Uploads\airlines.csv"