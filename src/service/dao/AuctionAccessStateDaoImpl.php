<?php

class AuctionAccessStateDaoImpl implements IAuctionAccessStateDao
{
  public function insertAuctionAccessState($auctionId, $bidderId): ?int
  {
    $request = 'INSERT INTO AuctionAccessState(auctionId, bidderId, stateId) VALUES (?,?,0)';

    try {
      $query = db()->prepare($request);
      $params = [$auctionId, $bidderId];
      $query->execute($params);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return db()->lastInsertId();
  }

  public function deleteAuctionAccessStateById(int $id): bool
  {
    $request = 'DELETE FROM AuctionAccessState WHERE id=?';

    try {
      $query = db()->prepare($request);
      $success = $query->execute([$id]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return $success;
  }

  public function updateStateIdByAuctionAccessStateId(int $auctionAccessStateId, int $stateId): bool
  {
    $request = 'UPDATE AuctionAccessState SET stateId = :stateId WHERE id = :id';

    try {
      $query = db()->prepare($request);
      $params = ['stateId'=>$stateId, 'id'=>$auctionAccessStateId];
      $success = $query->execute($params);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return $success;
  }

  public function selectAllAuctionAccessStateBySellerIdAndStateId(int $sellerId, int $stateId): array
  {
    $request = 'SELECT aas.id AS auctionAccessStateId, aas.auctionId, aas.bidderId, aas.stateId
                    ,Auction.name AS auctionName, Auction.sellerId
                    ,User.firstName AS bidderFirstName,User.lastName AS bidderLastName
                FROM AuctionAccessState AS aas
                INNER JOIN Auction
                    ON aas.auctionId = Auction.id
                INNER JOIN User
                    ON User.id = aas.bidderId
                WHERE Auction.sellerId = :sellerId
                    AND aas.stateId = :stateId';

    try {
      $query = db()->prepare($request);
      $params = ['sellerId'=>$sellerId, 'stateId'=>$stateId];
      $query->execute($params);
      $auctionAccessStateSelected = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    $auctionAccessStateList = [];
    foreach ($auctionAccessStateSelected as $oneAuctionAccessState) {
      $oneAuctionAccessStateModel = new AuctionAccessStateModel();
      $oneAuctionAccessStateModel
          ->setId($oneAuctionAccessState['auctionAccessStateId'])
          ->setAuction($oneAuctionAccessStateModel->getAuction()
                                                ->setId($oneAuctionAccessState['auctionId'])
                                                ->setName($oneAuctionAccessState['auctionName'])
                                                ->setSellerId($oneAuctionAccessState['sellerId']))
          ->setBidder($oneAuctionAccessStateModel->getBidder()
                                                ->setId($oneAuctionAccessState['bidderId'])
                                                ->setFirstName($oneAuctionAccessState['bidderFirstName'])
                                                ->setLastName($oneAuctionAccessState['bidderLastName']))
          ->setStateId($oneAuctionAccessState['stateId']);

      array_push($auctionAccessStateList, $oneAuctionAccessStateModel);
    }

    return $auctionAccessStateList;
  }
}
