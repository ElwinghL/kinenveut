<?php

class AuctionDaoImpl implements IAuctionDao
{
  public function selectAllAuctionsByAuctionState($auctionState): array
  {
    $auctions = null;
    $request = 'SELECT Auction.id AS objectId,name,description,basePrice,reservePrice,pictureLink,startDate,duration,auctionState,sellerId,privacyId,categoryId
    ,v_BestBid.id AS bidId,v_BestBid.bidPrice,v_BestBid.bidDate,v_BestBid.bidderId
    FROM Auction
    LEFT JOIN v_BestBid ON v_BestBid.objectId = Auction.id
    WHERE auctionState = :auctionState
        AND (CASE WHEN auctionState = 0 THEN privacyId is not null
            ELSE privacyId in (0,1)
            END);';

    try {
      $query = db()->prepare($request);
      $query->execute(['auctionState' => $auctionState]);
      $auctions = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

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
        ->setName(protectStringToDisplay($oneAuction['name']))
        ->setDescription(protectStringToDisplay($oneAuction['description']))
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

  public function selectAuctionByAuctionId(int $auctionId): ?AuctionModel
  {
    $oneAuction = null;
    $request = 'SELECT Auction.id AS objectId,name,description,basePrice,reservePrice,pictureLink,startDate,duration,auctionState,sellerId,privacyId,categoryId
    ,v_BestBid.id AS bidId,v_BestBid.bidPrice,v_BestBid.bidDate,v_BestBid.bidderId
    FROM Auction
    LEFT JOIN v_BestBid ON v_BestBid.objectId = Auction.id
    WHERE Auction.id = :id';

    try {
      $query = db()->prepare($request);
      $query->execute(['id' => $auctionId]);
      $oneAuction = $query->fetch();
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    if ($oneAuction === null) {
      return null;
    }

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

    return $oneAuctionModel;
  }

  public function selectAllAuctionsBySellerId($sellerId): array
  {
    $auctions = null;
    $request = 'SELECT Auction.id AS objectId,name,description,basePrice,reservePrice,pictureLink,startDate,duration,auctionState,sellerId,privacyId,categoryId
                    ,v_BestBid.id AS bidId,v_BestBid.bidPrice,v_BestBid.bidDate,v_BestBid.bidderId
                    FROM Auction
                    LEFT JOIN v_BestBid ON v_BestBid.objectId = Auction.id
                    WHERE sellerId = :sellerId ORDER BY auctionState';

    try {
      $query = db()->prepare($request);
      $query->execute(['sellerId' => $sellerId]);
      $auctions = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

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
        ->setName(protectStringToDisplay($oneAuction['name']))
        ->setDescription(protectStringToDisplay($oneAuction['description']))
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

  public function selectAcceptedConfidentialAuctionsByBidderId($userId): array
  {
    $auctions = null;
    $request = 'SELECT Auction.id AS objectId,name,description,basePrice,reservePrice,pictureLink,startDate,duration,auctionState,sellerId,privacyId,categoryId
    ,v_BestBid.id AS bidId,v_BestBid.bidPrice,v_BestBid.bidDate,v_BestBid.bidderId
    FROM Auction
    LEFT JOIN v_BestBid ON v_BestBid.objectId = Auction.id
    INNER JOIN AuctionAccessState ON AuctionAccessState.auctionId = Auction.id
    WHERE AuctionAccessState.bidderId = :bidderId
        AND AuctionAccessState.stateId = 1
        AND privacyId = 2';

    try {
      $query = db()->prepare($request);
      $query->execute(['bidderId' => $userId]);
      $auctions = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

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
        ->setName(protectStringToDisplay($oneAuction['name']))
        ->setDescription(protectStringToDisplay($oneAuction['description']))
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

  public function insertAuction(AuctionModel $auction): ?int
  {
    $request = "INSERT INTO Auction(name, description, basePrice, reservePrice, pictureLink, /*startDate,*/ duration, auctionState, sellerId, privacyId, categoryId) VALUES (?, ?, ?, ?, ' ',/* ?,*/ ?, 0, ?, ?, ?)";

    try {
      $query = db()->prepare($request);
      $query->execute([utf8_decode($auction->getName()), utf8_decode($auction->getDescription()), $auction->getBasePrice(), $auction->getReservePrice(), /*$auction->getPictureLink(), $auction->getStartDate(),*/ $auction->getDuration(), $auction->getSellerId(), $auction->getPrivacyId(), $auction->getCategoryId()]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return db()->lastInsertId();
  }

  public function deleteAuctionById(int $auctionId): bool
  {
    $success = null;
    $request = 'DELETE FROM Auction WHERE id=?';

    try {
      $query = db()->prepare($request);
      $success = $query->execute([$auctionId]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $success;
  }

  public function updateStartDateAndAuctionState(AuctionModel $auction): bool
  {
    $success = null;
    $request = 'UPDATE Auction SET startDate = :startDate, auctionState = :auctionState WHERE id = :id';

    if ($auction->getId() != null) {
      try {
        $query = db()->prepare($request);
        $success = $query->execute(['id' => $auction->getId(), 'startDate' => $auction->getStartDate(), 'auctionState' => $auction->getAuctionState()]);
      } catch (PDOException $Exception) {
        throw new BDDException($Exception->getMessage(), $Exception->getCode());
      }
    }

    return $success;
  }

  public function updateAuctionState(AuctionModel $auction): bool
  {
    $success = null;
    $request = 'UPDATE Auction SET auctionState = :auctionState WHERE id = :id';

    try {
      $query = db()->prepare($request);
      $success = $query->execute(['id' => $auction->getId(), 'auctionState' => $auction->getAuctionState()]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $success;
  }
}
