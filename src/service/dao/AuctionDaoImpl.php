<?php

class AuctionDaoImpl implements IAuctionDao
{
  public function getAllAuctionsByAuctionState($auctionSate) : array
  {
    $request = db()->prepare('SELECT objects.id AS objectId,name,description,basePrice,reservePrice,pictureLink,startDate,duration,auctionState,sellerId,privacyId,categoryId
                    ,v_BestBids.id AS bidId,v_BestBids.bidPrice,v_BestBids.bidDate,v_BestBids.bidderId
                    FROM objects
                    LEFT JOIN v_BestBids ON v_BestBids.objectId = objects.id
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
      $request = db()->prepare('SELECT * FROM Objects');
      $request->execute();
      $auctions = $request->fetchAll();

      return $auctions;
  }*/
  public function insertAuction(AuctionModel $auction)
  {
    $request = db()->prepare("INSERT INTO Objects(name, description, basePrice, reservePrice, pictureLink, startDate, endDate, isCancelled, sellerId, privacyId, categoryId) VALUES (?, ?, ?, ?, ' ', ?, ?, false, 2, ?, ?)");
    $success = $request->execute([$auction->getName(), $auction->getDescription(), $auction->getBasePrice(), $auction->getReservePrice(), $auction->getStartDate(), $auction->getEndDate(), $auction->getPrivacyId(), $auction->getCategoryId()]);

    return $success;
  }
}
