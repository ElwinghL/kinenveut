DROP VIEW IF EXISTS v_BestBids;
DROP VIEW IF EXISTS v_BestBid;

CREATE VIEW v_BestBid AS
SELECT bidhistory.id,bidhistory.bidPrice,bidhistory.bidDate,bidhistory.objectId,bidhistory.bidderId
FROM (
         SELECT bidhistory.*
         FROM bidhistory
                  INNER JOIN (SELECT objectId, MAX(bidPrice) AS bidPrice
                              FROM bidhistory
                              GROUP BY bidhistory.objectId) as bestBid
                             ON bidhistory.objectId = bestBid.objectId
                                 AND bidhistory.bidPrice = bestBid.bidPrice
         GROUP BY bidhistory.objectId
     ) AS bestBid
         INNER JOIN (SELECT id,bidPrice,objectId,bidderId, MIN(bidDate) AS bidDate
                     FROM bidhistory
                     GROUP BY id,bidPrice,objectId,bidderId) as bidhistory
                    ON bidhistory.objectId = bestBid.objectId
                        AND bidhistory.bidPrice = bestBid.bidPrice
                        AND bidhistory.bidDate = bestBid.bidDate
GROUP BY bidhistory.objectId;