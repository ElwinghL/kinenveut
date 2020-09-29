DROP DATABASE IF EXISTS kinenveut;
CREATE DATABASE kinenveut CHARACTER SET 'utf8';

CREATE TABLE `kinenveut`.`Users` (
`id` INT NOT NULL AUTO_INCREMENT,
`firstName` VARCHAR(100) NOT NULL,
`lastName` VARCHAR(100) NOT NULL,
`email` VARCHAR(255) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`birthDate` DATE NOT NULL,
`isAuthorised` INT DEFAULT NULL,
`isAdmin` BOOLEAN,
PRIMARY KEY (`id`),
UNIQUE `Unicite_Mail` (`email`)
) ENGINE = MyISAM;

CREATE TABLE `kinenveut`.`Categories` (
`id` SMALLINT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(100) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE `Unicite_Name` (`name`)
) ENGINE = MyISAM;

CREATE TABLE `kinenveut`.`Objects` (
`id` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255) NOT NULL,
`description` TEXT NOT NULL,
`basePrice` INT NOT NULL,
`reservePrice` INT NOT NULL,
`pictureLink` TEXT NOT NULL,
`startDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
`endDate` DATETIME NOT NULL,
`auctionState` INT NULL,
`sellerId` INT NOT NULL,
`privacyId` INT NOT NULL,
`categoryId` INT NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (sellerId) REFERENCES Users(id),
FOREIGN KEY (categoryId) REFERENCES Categories(id),
INDEX ind_name (name),
INDEX ind_sellerId (sellerId),
INDEX ind_categoryId (categoryId)
) ENGINE = MyISAM;

CREATE TABLE `kinenveut`.`BidHistory` (
`id` INT NOT NULL AUTO_INCREMENT,
`bidPrice` INT NOT NULL,
`bidDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
`objectId` INT NOT NULL,
`bidderId` INT NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (objectId) REFERENCES Objects(id),
FOREIGN KEY (bidderId) REFERENCES Users(id),
INDEX ind_bidderId (bidderId)
) ENGINE = MyISAM;

CREATE VIEW V_Privacy
AS SELECT 0 AS id, 'public' AS name
UNION SELECT 1 AS id, 'privée' AS name
UNION SELECT 2 AS id, 'confidentielle' AS name;

LOCK TABLES kinenveut.Users WRITE;
INSERT INTO `kinenveut`.`Users` (`firstName`,`lastName`,`email`,`birthDate`,`password`,`isAuthorised`,`isAdmin`)
VALUES
('Admin','','admin@kinenveut.fr','1950-01-01','password',1,1);
UNLOCK TABLES;

LOCK TABLES `kinenveut`.`Categories` WRITE;
INSERT INTO `kinenveut`.`Categories` (`name`)
VALUES
('Non défni')
,('Vêtements')
,('Bijoux')
,('Multimédia')
,('Instruments de musique');
UNLOCK TABLES;

