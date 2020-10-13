#Update some values
UPDATE Auction SET auctionState = 0 WHERE auctionState is null;
UPDATE User SET isAuthorised = 0 WHERE isAuthorised is null;
UPDATE User SET isAdmin = 0 WHERE isAdmin is null;

#Update default value
ALTER TABLE Auction
    MODIFY COLUMN basePrice INT NOT NULL DEFAULT '0',
    MODIFY COLUMN reservePrice INT NOT NULL DEFAULT '0',
    MODIFY COLUMN duration INT NOT NULL DEFAULT '1',
    MODIFY COLUMN auctionState INT NOT NULL DEFAULT '0',
    MODIFY COLUMN privacyId INT NOT NULL DEFAULT '0',
    MODIFY COLUMN categoryId INT NOT NULL DEFAULT '1';

ALTER TABLE AuctionAccessState
    MODIFY COLUMN stateId INT NOT NULL DEFAULT '0';

ALTER TABLE User
    MODIFY COLUMN isAuthorised INT NOT NULL DEFAULT '0',
    MODIFY COLUMN isAdmin BOOLEAN NOT NULL DEFAULT '0';

#Add constraints
ALTER TABLE Auction
    ADD CONSTRAINT CHK_AuctionState FOREIGN KEY (auctionState) REFERENCES v_State(id);

ALTER TABLE AuctionAccessState
    ADD CONSTRAINT CHK_State FOREIGN KEY (stateId) REFERENCES v_State(id);

ALTER TABLE BidHistory
    ADD CONSTRAINT AK_BIDDER_OBJECT_PRICE UNIQUE (bidPrice, objectId, bidderId);

ALTER TABLE User
    ADD CONSTRAINT CHK_IsAuthorized FOREIGN KEY (isAuthorised) REFERENCES v_State(id);
