DROP VIEW IF EXISTS v_BestBids;
DROP VIEW IF EXISTS v_BestBid;

CREATE VIEW v_BestBid AS
SELECT BidHistory.id,BidHistory.bidPrice,BidHistory.bidDate,BidHistory.objectId,BidHistory.bidderId
FROM (
         SELECT BidHistory.*
         FROM BidHistory
                  INNER JOIN (SELECT objectId, MAX(bidPrice) AS bidPrice
                              FROM BidHistory
                              GROUP BY BidHistory.objectId) as bestBid
                             ON BidHistory.objectId = bestBid.objectId
                                 AND BidHistory.bidPrice = bestBid.bidPrice
         GROUP BY BidHistory.objectId
     ) AS bestBid
         INNER JOIN (SELECT id,bidPrice,objectId,bidderId, MIN(bidDate) AS bidDate
                     FROM BidHistory
                     GROUP BY id,bidPrice,objectId,bidderId) as BidHistory
                    ON BidHistory.objectId = bestBid.objectId
                        AND BidHistory.bidPrice = bestBid.bidPrice
                        AND BidHistory.bidDate = bestBid.bidDate
GROUP BY BidHistory.objectId;
