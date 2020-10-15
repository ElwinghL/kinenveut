<?php

class AuctionAccessStateDaoImpl implements IAuctionAccessStateDao
{
  public function insertAuctionAccessState($auctionId, $bidderId): ?int
  {
    $request = 'INSERT INTO AuctionAccessState(auctionId, bidderId, stateId) VALUES (?,?,0)';

    try {
      $query = db()->prepare($request);
      $query->execute([$auctionId, $bidderId]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return db()->lastInsertId();
  }

  public function deleteAuctionAccessStateById(int $id): bool
  {
    $success = null;
    $request = 'DELETE FROM AuctionAccessState WHERE id=?';

    try {
      $query = db()->prepare($request);
      $success = $query->execute([$id]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $success;
  }

  public function updateStateIdByAuctionAccessStateId(int $auctionAccessStateId, int $stateId): bool
  {
    $success = null;
    $request = 'UPDATE AuctionAccessState SET stateId = :stateId WHERE id = :id';

    try {
      $query = db()->prepare($request);
      $success = $query->execute(['stateId' => $stateId, 'id' => $auctionAccessStateId]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $success;
  }

  public function updateStateIdByAuctionIdAndBidderId(int $auctionId, int $bidderId, int $stateId): bool
  {
    $success = null;
    $request = 'UPDATE AuctionAccessState SET stateId = :stateId WHERE auctionId = :auctionId AND bidderId = :bidderId';

    try {
      $query = db()->prepare($request);
      $success = $query->execute(['stateId' => $stateId, 'auctionId' => $auctionId, 'bidderId' => $bidderId]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $success;
  }

  public function selectAuctionAccessStateByAuctionIdAndBidderId(int $auctionId, int $bidderId): ?AuctionAccessStateModel
  {
    $auctionAccessStateSelected = null;
    $request = 'SELECT aas.id AS auctionAccessStateId, aas.auctionId, aas.bidderId, aas.stateId
                FROM AuctionAccessState AS aas
                WHERE aas.auctionId = :auctionId
                    AND aas.bidderId = :bidderId';

    try {
      $query = db()->prepare($request);
      $query->execute(['auctionId' => $auctionId, 'bidderId' => $bidderId]);
      $auctionAccessStateSelected = $query->fetch();
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    $oneAuctionAccessStateModel = null;
    if ($auctionAccessStateSelected) {
      $oneAuctionAccessStateModel = new AuctionAccessStateModel();
      $oneAuctionAccessStateModel
        ->setId($auctionAccessStateSelected['auctionAccessStateId'])
        ->setAuction($oneAuctionAccessStateModel->getAuction()
          ->setId($auctionAccessStateSelected['auctionId']))
        ->setBidder($oneAuctionAccessStateModel->getBidder()
          ->setId($auctionAccessStateSelected['bidderId']))
        ->setStateId($auctionAccessStateSelected['stateId']);
    }

    return $oneAuctionAccessStateModel;
  }

  public function selectAllAuctionAccessStateBySellerIdAndStateId(int $sellerId, int $stateId): array
  {
    $auctionAccessStateSelected = null;
    $request = 'SELECT aas.id AS auctionAccessStateId, aas.auctionId, aas.bidderId, aas.stateId
                    ,Auction.name AS auctionName, Auction.sellerId
                    ,User.firstName AS bidderFirstName,User.lastName AS bidderLastName
                FROM AuctionAccessState AS aas
                INNER JOIN Auction
                    ON aas.auctionId = Auction.id
                INNER JOIN User
                    ON User.id = aas.bidderId
                WHERE Auction.sellerId = :sellerId
                    AND aas.stateId = :stateId
                ORDER BY aas.id DESC';

    try {
      $query = db()->prepare($request);
      $query->execute(['sellerId' => $sellerId, 'stateId' => $stateId]);
      $auctionAccessStateSelected = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    $auctionAccessStateList = [];
    foreach ($auctionAccessStateSelected as $oneAuctionAccessState) {
      $oneAuctionAccessStateModel = new AuctionAccessStateModel();
      $oneAuctionAccessStateModel
        ->setId($oneAuctionAccessState['auctionAccessStateId'])
        ->setAuction($oneAuctionAccessStateModel
          ->getAuction()
          ->setId($oneAuctionAccessState['auctionId'])
          ->setName(protectStringToDisplay($oneAuctionAccessState['auctionName']))
          ->setSellerId($oneAuctionAccessState['sellerId']))
        ->setBidder($oneAuctionAccessStateModel
          ->getBidder()
          ->setId($oneAuctionAccessState['bidderId'])
          ->setFirstName(protectStringToDisplay($oneAuctionAccessState['bidderFirstName']))
          ->setLastName(protectStringToDisplay($oneAuctionAccessState['bidderLastName'])))
        ->setStateId($oneAuctionAccessState['stateId']);

      array_push($auctionAccessStateList, $oneAuctionAccessStateModel);
    }

    return $auctionAccessStateList;
  }

  public function selectNumberOfAuctionAccessStateBySellerId(int $sellerId): int
  {
    $numberOfAAS = null;
    $request = 'SELECT count(*)
                FROM AuctionAccessState AS aas
                INNER JOIN Auction
                    ON aas.auctionId = Auction.id
                WHERE Auction.sellerId = :sellerId
                AND aas.stateId = 0';

    try {
      $query = db()->prepare($request);
      $query->execute(['sellerId' => $sellerId]);
      $numberOfAAS = $query->fetch();
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $numberOfAAS[0];
  }
}
