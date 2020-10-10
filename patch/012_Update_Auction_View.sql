DROP VIEW IF EXISTS V_Auction;
DROP VIEW IF EXISTS v_Auction;

CREATE VIEW v_Auction AS
SELECT Auction.id AS objectId
     ,name,description,basePrice,reservePrice,pictureLink
     ,startDate,duration
     #If endDate is before now then auctionState = 4 (finish state)
     ,(CASE WHEN DATE_ADD(Auction.startDate,interval Auction.duration day) < NOW() THEN 4 ELSE Auction.auctionState END) AS auctionState
     ,DATE_ADD(Auction.startDate, INTERVAL Auction.duration DAY) AS endDate
     ,sellerId,privacyId,categoryId
     ,v_BestBid.id AS bidId
     ,v_BestBid.bidPrice,v_BestBid.bidDate,v_BestBid.bidderId
FROM Auction
LEFT JOIN v_BestBid
    ON v_BestBid.objectId = Auction.id;
