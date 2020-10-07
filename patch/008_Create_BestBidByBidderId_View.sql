CREATE VIEW V_BestBidByBidderId AS
SELECT BidHistory.id,BidHistory.bidPrice,BidHistory.bidDate,BidHistory.objectId,BidHistory.bidderId
FROM BidHistory
         INNER JOIN (
    SELECT BidHistory.bidderId, BidHistory.objectId, MAX(BidHistory.bidPrice) AS bidPrice
    FROM BidHistory
    GROUP BY BidHistory.bidderId,objectId
) as bestBid
ON BidHistory.bidderId = bestBid.bidderId
    AND BidHistory.objectId = bestBid.objectId
    AND BidHistory.bidPrice = bestBid.bidPrice