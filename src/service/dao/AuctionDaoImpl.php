<?php

class AuctionDaoImpl implements IAuctionDao
{
  public function selectAllAuctionsByAuctionState($auctionSate) : array
  {
    $request = db()->prepare('SELECT Auction.id AS objectId,name,description,basePrice,reservePrice,pictureLink,startDate,duration,auctionState,sellerId,privacyId,categoryId
                    ,v_BestBid.id AS bidId,v_BestBid.bidPrice,v_BestBid.bidDate,v_BestBid.bidderId
                    FROM Auction
                    LEFT JOIN v_BestBid ON v_BestBid.objectId = Auction.id
                    WHERE auctionState = :auctionSate');

    $request->execute(['auctionSate'=>$auctionSate]);

    $auctions = $request->fetchAll(PDO::FETCH_ASSOC);

    $auctionList = [];
    foreach ($auctions as $oneAuction) {
      $theBestBid = new BidModel();
      $theBestBid
            ->setId($oneAuction['bidId'])
            ->setBidPrice($oneAuction['bidPrice'])
            ->setBidDate($oneAuction['bidDate'])
            ->setBidderId($oneAuction['bidderId'])
            ->setObjectId($oneAuction['objectId']);

      $oneAuctionModel = new AuctionModel();
      $oneAuctionModel
              ->setId($oneAuction['objectId'])
                ->setName($oneAuction['name'])
                ->setDescription($oneAuction['description'])
                ->setBasePrice($oneAuction['basePrice'])
                ->setReservePrice($oneAuction['reservePrice'])
                ->setPictureLink($oneAuction['pictureLink'])
                ->setStartDate($oneAuction['startDate'])
                ->setDuration($oneAuction['duration'])
                ->setAuctionState($oneAuction['auctionState'])
                ->setSellerId($oneAuction['sellerId'])
                ->setPrivacyId($oneAuction['privacyId'])
                ->setCategoryId($oneAuction['categoryId'])
                ->setBestBid($theBestBid);

      array_push($auctionList, $oneAuctionModel);
    }

    return $auctionList;
  }

  /*public function selectAllAuctions()
  {
      $request = db()->prepare('SELECT * FROM Auction');
      $request->execute();
      $auctions = $request->fetchAll();

      return $auctions;
  }*/
  public function insertAuction(AuctionModel $auction)
  {
    $request = db()->prepare("INSERT INTO Auction(name, description, basePrice, reservePrice, pictureLink, startDate, duration, auctionState, sellerId, privacyId, categoryId) VALUES (?, ?, ?, ?, ' ', ?, ?, 0, ?, ?, ?)");

    $result = $request->execute([$auction->getName(), $auction->getDescription(), $auction->getBasePrice(), $auction->getReservePrice(), /*$auction->getPictureLink(),*/ $auction->getStartDate(), $auction->getDuration(), $auction->getSellerId(), $auction->getPrivacyId(), $auction->getCategoryId()]);

    return $result;
  }
}
