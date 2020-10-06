CREATE TABLE `AuctionAccessState` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `auctionId` INT NOT NULL,
    `bidderId` INT NOT NULL,
    `stateId` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;