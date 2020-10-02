CREATE TABLE `User` (
                                     `id` INT NOT NULL AUTO_INCREMENT,
                                     `firstName` VARCHAR(100) NOT NULL,
                                     `lastName` VARCHAR(100) NOT NULL,
                                     `email` VARCHAR(255) NOT NULL,
                                     `password` VARCHAR(255) NOT NULL,
                                     `birthDate` DATE NOT NULL,
                                     `isAuthorised` INT DEFAULT NULL, ##NULL : waitinf for the admin decision, 0: NO/BAN, 1:YES
                                     `isAdmin` BOOLEAN, ##0: NO, 1:YES
                                     PRIMARY KEY (`id`),
                                     UNIQUE `Unicite_Mail` (`email`)
) ENGINE = MyISAM;

CREATE TABLE `Category` (
                                          `id` SMALLINT NOT NULL AUTO_INCREMENT,
                                          `name` VARCHAR(100) NOT NULL,
                                          PRIMARY KEY (`id`),
                                          UNIQUE `Unicite_Name` (`name`)
) ENGINE = MyISAM;

CREATE TABLE `Auction` (
                                       `id` INT NOT NULL AUTO_INCREMENT,
                                       `name` VARCHAR(255) NOT NULL,
                                       `description` TEXT NOT NULL,
                                       `basePrice` INT NOT NULL,
                                       `reservePrice` INT NOT NULL,
                                       `pictureLink` TEXT NOT NULL,
##`creationDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, not used for now
                                       `startDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                       `duration` INT NOT NULL, ##definite the duration of the auction
                                       `auctionState` INT NULL, ##NULL : waitinf for the admin decision, Refused, 1:Online, 2:Cancelled
                                       `sellerId` INT NOT NULL,
                                       `privacyId` INT NOT NULL,
                                       `categoryId` INT NOT NULL,
                                       PRIMARY KEY (`id`),
                                       FOREIGN KEY (sellerId) REFERENCES User(id),
                                       FOREIGN KEY (privacyId) REFERENCES V_Privacy(id),
                                       FOREIGN KEY (categoryId) REFERENCES Category(id),
                                       INDEX ind_name (name),
                                       INDEX ind_sellerId (sellerId),
                                       INDEX ind_categoryId (categoryId)
) ENGINE = MyISAM;

CREATE TABLE `BidHistory` (
                                          `id` INT NOT NULL AUTO_INCREMENT,
                                          `bidPrice` INT NOT NULL,
                                          `bidDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                          `objectId` INT NOT NULL,
                                          `bidderId` INT NOT NULL,
                                          PRIMARY KEY (`id`),
                                          FOREIGN KEY (objectId) REFERENCES Auction(id),
                                          FOREIGN KEY (bidderId) REFERENCES User(id),
                                          INDEX ind_bidderId (bidderId)
) ENGINE = MyISAM;

CREATE VIEW v_Privacy
AS SELECT 0 AS id, 'public' AS name
   UNION SELECT 1 AS id, 'privée' AS name
   UNION SELECT 2 AS id, 'confidentielle' AS name;

CREATE VIEW v_BestBid AS
SELECT bidhistory.id,bidhistory.bidPrice,bidhistory.bidDate,bidhistory.objectId,bidhistory.bidderId
FROM (SELECT * FROM bidhistory
      WHERE bidPrice = (SELECT MAX(bidPrice) FROM bidhistory)
      GROUP BY bidhistory.objectId
     ) AS bidhistory
WHERE bidDate = (SELECT MIN(bidDate) FROM bidhistory)
GROUP BY bidhistory.objectId;

LOCK TABLES User WRITE;
INSERT INTO `User` (`firstName`,`lastName`,`email`,`birthDate`,`password`,`isAuthorised`,`isAdmin`)
VALUES
('Admin','','admin@kinenveut.fr','1950-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,1); ##The password is : password
UNLOCK TABLES;

LOCK TABLES `Category` WRITE;
INSERT INTO `Category` (`name`)
VALUES
    ('Non défini')
     ,('Vêtements')
     ,('Bijoux')
     ,('Multimédia')
     ,('Instruments de musique');
UNLOCK TABLES;
