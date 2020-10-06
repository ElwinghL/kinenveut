CREATE VIEW V_Auction AS
SELECT Auction.id AS objectId,name,description,basePrice,reservePrice,pictureLink,startDate,DATE_ADD(startDate, INTERVAL duration DAY) AS endDate, duration,auctionState,sellerId,privacyId,categoryId
     ,v_BestBid.id AS bidId,v_BestBid.bidPrice,v_BestBid.bidDate,v_BestBid.bidderId
FROM Auction
LEFT JOIN v_BestBid ON v_BestBid.objectId = Auction.id
