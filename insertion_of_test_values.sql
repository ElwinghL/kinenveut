##DO NOT ADD IT WHILE IN PRODUCTION
##File used to add test values in the data base of test

##----- User

TRUNCATE TABLE User;

LOCK TABLES User WRITE;
INSERT INTO `User` (`id`,`firstName`,`lastName`,`email`,`birthDate`,`password`,`isAuthorised`,`isAdmin`)
VALUES
    (1,'Admin','','admin@kinenveut.fr','1950-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,1) ##The password is : password
    ,(2,'Test','FamilyTest','test@kinenveut.fr','1975-01-01','05a671c66aefea124cc08b76ea6d30bb',1,0) ##The password is : testtest
     #BAN people
    ,(3,'George','VSGCZDE','george@kinenveut.fr','1855-01-01','5f4dcc3b5aa765d61d8327deb882cf99',6,0) ##The password is : password, he is BAN
    ,(4,'BHEVCDGAZVGAVAG','VSGCZDE','ban@kinenveut.fr','1855-01-01','5f4dcc3b5aa765d61d8327deb882cf99',6,0) ##The password is : password, he is BAN
    #Refused people
    #Authorized people
    ,(5,'Nathalia','Fratelli','nathalia@kinenveut.fr','1987-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(6,'Victor','Lefort','victor@kinenveut.fr','1967-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(7,'Géraldine','Lamaline','geraldine@kinenveut.fr','1970-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(8,'Hector','Ledur','hector@kinenveut.fr','1970-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(9,'Pascaline','Lapraline','pascaline@kinenveut.fr','1970-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(10,'Leatitia','Paparla','leatitia@kinenveut.fr','1970-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(11,'Big','Brother','big@kinenveut.fr','1970-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(12,'Mamadou','Toudou','mamadou@kinenveut.fr','1970-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(13,'Bernard','Lermit','bernard@kinenveut.fr','1970-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(14,'Remi','Lami','remi@kinenveut.fr','1990-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(15,'Antoine','Superman','antoine@kinenveut.fr','1990-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(16,'Bastien','Baba','bastien@kinenveut.fr','1990-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(17,'Axel','Superzel','axel@kinenveut.fr','1990-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(18,'Ophélie','Pali','ophelie@kinenveut.fr','1990-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
    ,(19,'Clément','Démant','clement@kinenveut.fr','1990-01-01','5f4dcc3b5aa765d61d8327deb882cf99',1,0) ##The password is : password
     #Last suscribers
    ,(20,'Manon','Tanon','manon@kinenveut.fr','1975-01-01','5f4dcc3b5aa765d61d8327deb882cf99',0,0) ##The password is : password, she just suscribed
    ,(21,'Kevin','Souris','kevin@kinenveut.fr','1945-01-01','5f4dcc3b5aa765d61d8327deb882cf99',0,0) ##The password is : password, he just suscribed
;
UNLOCK TABLES;


##----- Category

TRUNCATE TABLE Category;

LOCK TABLES `Category` WRITE;
INSERT INTO `Category` (`id`,`name`)
VALUES
    (1,'Non défini')
     ,(2,'Vêtements')
     ,(3,'Bijoux')
     ,(4,'Multimédia')
     ,(5,'Instruments de musique');
UNLOCK TABLES;

##----- Auction
##auctionState : -1-waiting for answer; 0-refused; 1-online; 2-canceled; 3-finished earlier
##privacyId : 0-public; 1-private; 2-confidential

TRUNCATE TABLE Auction;

LOCK TABLES `Auction` WRITE;
INSERT INTO `Auction` (id, name, description, basePrice, reservePrice, pictureLink, startDate, duration, auctionState, sellerId, privacyId, categoryId)
VALUES
#Auction state : Finished/Finished earlier
     #Privacy : Public
    (1,'Fin Puppy', 'This object is Finished & Public', 0, 0, '', '2020-09-01', 7, 6, 12, 0, 1)
    ,(2,'Fin Public', 'This object is Finished & Public', 0, 0, '', '2020-09-01', 8, 3, 13,  0, 2)
    #Privacy : Private
    ,(3,'Fin PVpuppy', 'This object is Finished & Private', 0, 0, '', '2020-09-01', 7, 3, 8, 1, 1)
    ,(4,'Fin  Private', 'This object is Finished & Private', 0, 0, '', '2020-09-01', 8, 6, 15, 1, 3)
    #Privacy : Confidential
    ,(5,'Fin Confidential', 'This object is Finished & Confidential', 0, 0, '', '2020-09-01', 8, 3, 15, 2, 4)
    ,(6,'Fin My Cppupy', 'This object is Finished & Confidential', 0, 0, '', '2020-09-01', 7, 6, 9, 2, 1)

#Auction state : Canceled
    #Privacy : Public
    ,(7,'Can My P objet', 'This object is Canceled & Public', 0, 0, '', '2020-09-01', 7, 2, 3, 0, 1)
    ,(8,'Can Public', 'This object is Canceled & Public', 0, 0, '', '2020-09-01', 8, 2, 13, 15, 1)
    #Privacy : Private
    ,(9,'Can My PV objet', 'This object is Canceled & Private', 0, 0, '', '2020-09-01', 8, 2, 4, 1, 1)
    ,(10,'Can  Private', 'This object is Canceled & Private', 0, 0, '', '2020-09-01', 7, 2, 15, 1, 1)
    #Privacy : Confidential
    ,(11,'Can My C objet', 'This object is Canceled & Confidential', 0, 0, '', '2020-09-01', 7, 2, 19, 2, 1)
    ,(12,'Can Confidential', 'This object is Canceled & Confidential', 0, 0, '', '2020-09-01', 8, 2, 16, 2, 1)

#Auction state : Refused
     #Privacy : Public
     ,(13,'Ref P objet', 'This object is Refused & Public', 0, 0, '', '2020-09-01', 7, 5, 7, 0, 1)
     ,(14,'Ref Public', 'This object is Refused & Public', 0, 0, '', '2020-09-01', 8, 5, 6, 0, 1)
     #Privacy : Private
     ,(15,'Ref PV objet', 'This object is Refused & Private', 0, 0, '', '2020-09-01', 7, 5, 8, 1, 1)
     ,(16,'Ref Private', 'This object is Refused & Private', 0, 0, '', '2020-09-01', 8, 5, 5, 1, 1)
     #Privacy : Confidential
     ,(17,'Ref C objet', 'This object is Refused & Confidential', 0, 0, '', '2020-09-01', 8, 5, 7, 2, 1)
     ,(18,'Ref Confidential', 'This object is Refused & Confidential', 0, 0, '', '2020-09-01', 7, 5, 15, 2, 1)

#Auction state : Online
     #Privacy : Public
     ,(19,'Un lit', 'This object is Online & Public', 0, 0, '', '2020-10-01', 8, 1, 6, 0, 1)
     ,(20,'One PublicObjet', 'This object is Online & Public', 0, 0, '', '2020-10-01', 7, 1, 5, 0, 1)
     ,(21,'Une chaussette', 'This object is Online & Public', 0, 0, '', '2020-10-01', 8, 1, 6, 0, 1)
     ,(26,'Une balançoire', 'This object is Online & Public', 0, 0, '', '2020-10-01', 7, 1, 7, 0, 1)
     ,(27,'La Joconde', 'This object is Online & Public', 0, 0, '', '2020-10-01', 8, 1, 6, 8, 1)
     ,(28,'Un bougeoire', 'This object is Online & Public', 0, 0, '', '2020-10-01', 8, 1, 9, 0, 1)
     ,(29,'Une vielle ferrari', 'This object is Online & Public', 0, 0, '', '2020-10-01', 12, 1, 19, 0, 1)
     #Privacy : Private
     ,(22,'My PV objet', 'This object is Online & Private', 0, 0, '', '2020-10-01', 7, 1, 8, 1, 1)
     ,(23,'Private', 'This object is Online & Private', 0, 0, '', '2020-10-01', 8, 1, 5, 1, 1)
     #Privacy : Confidential
     ,(24,'My C objet', 'This object is Online & Confidential', 0, 0, '', '2020-10-01', 8, 1, 7, 2, 1)
     ,(25,'Confidential', 'This object is Online & Confidential', 0, 0, '', '2020-10-01', 7, 1, 15, 2, 1)
#Auction state : Waiting for admin choice
    #Privacy : Public
    ,(30,'Adm P objet', 'This object is Waiting for admin choice & Public', 0, 0, '', '2020-09-01', 7, 0, 7, 0, 1)
    ,(31,'Adm Public', 'This object is Waiting for admin choice & Public', 0, 0, '', '2020-09-01', 8, 0, 6, 0, 1)
    #Privacy : Private
    ,(32,'Adm PV objet', 'This object is Waiting for admin choice & Private', 0, 0, '', '2020-09-01', 7, 0, 8, 1, 1)
    ,(33,'Adm Private', 'This object is Waiting for admin choice & Private', 0, 0, '', '2020-09-01', 8, 0, 5, 1, 1)
    #Privacy : Confidential
    ,(34,'Adm C objet', 'This object is Waiting for admin choice & Confidential', 0, 0, '', '2020-09-01', 8, 0, 7, 2, 1)
    ,(35,'Adm Confidential', 'This object is Waiting for admin choice & Confidential', 0, 0, '', '2020-09-01', 7, 0, 15, 2, 1)
;
UNLOCK TABLES;


##----- BidHistory

TRUNCATE TABLE BidHistory;

LOCK TABLES `BidHistory` WRITE;
INSERT INTO `BidHistory` (`bidPrice`,`bidDate`,`objectId`,`bidderId`)
VALUES
#Auction state : Finished/Finished earlier
    (10,'2020-09-01',1,5)
    ,(10,'2020-09-01',2,7)
    ,(15,'2020-09-01',2,9)
     ,(25,'2020-09-01',2,7)
     ,(25,'2020-09-01',2,16)
#Auction state : Canceled
     ,(25,'2020-09-01',7,7)
     ,(25,'2020-09-01',7,16)
#Auction state : Refused
#No bid
     ,(5,'2020-10-01',21,18)
     ,(10,'2020-10-01',21,15)
     ,(25,'2020-10-01',21,13)
     ,(10,'2020-10-01',23,8)
     ,(14,'2020-10-01',23,18)
     ,(19,'2020-10-01',23,19)
     ,(25,'2020-10-01',23,18)
     ,(36,'2020-10-01',23,19)
     ,(58,'2020-10-01',23,12)
     ,(75,'2020-10-01',23,18)
     ,(158,'2020-10-01',24,13)
     ,(38,'2020-10-01',26,16)
     ,(42,'2020-10-01',26,17)
     ,(55,'2020-10-01',26,12)
     ,(5,'2020-10-01',27,13)
     ,(16,'2020-10-01',27,15)
     ,(17,'2020-10-01',27,16)
     ,(18,'2020-10-01',27,9)
     ,(19,'2020-10-01',27,18)
     ,(26,'2020-10-01',27,9)
     ,(28,'2020-10-01',27,18)
     ,(35,'2020-10-01',27,19)
     ,(58,'2020-10-01',27,9)
     ,(99,'2020-10-01',27,17)
     ,(15,'2020-10-01',28,15)
     ,(35,'2020-10-01',28,16)
     ,(45,'2020-10-01',29,7)
     ,(76,'2020-10-01',29,6)
     ,(99,'2020-10-01',29,8)
     ,(118,'2020-10-01',29,6)
     ,(145,'2020-10-01',29,7)
     ,(184,'2020-10-01',29,8)
     ,(210,'2020-10-01',29,13)
#Auction state : Online

#Auction state : Waiting for admin choice
#No bid
;
UNLOCK TABLES;