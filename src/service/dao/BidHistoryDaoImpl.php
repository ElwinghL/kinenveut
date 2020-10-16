<?php

class BidHistoryDaoImpl implements IBidHistoryDao
{
  public function insertBid(BidModel $bid): ?int
  {
    $request = 'INSERT INTO BidHistory(bidPrice, objectId, bidderID) VALUES (?,?,?)';

    try {
      $query = db()->prepare($request);
      $query->execute([$bid->getBidPrice(), $bid->getObjectId(), $bid->getBidderId()]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return db()->lastInsertId();
  }

  public function deleteBidById(int $bidId): bool
  {
    $success = false;
    $request = 'DELETE FROM BidHistory WHERE id=?';

    try {
      $query = db()->prepare($request);
      $success = $query->execute([$bidId]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $success;
  }

  public function deleteCurrentBidsByBidderId(int $bidderId) : bool
  {
    $success = false;
    $request = 'DELETE bh
                FROM BidHistory bh
                INNER JOIN Auction a ON a.id = bh.objectId
                WHERE bidderId=:bidderId
                AND DATE_ADD(a.startDate,interval a.duration day) > NOW()';

    try {
      $query = db()->prepare($request);
      $success = $query->execute(['bidderId'=>$bidderId]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $success;
  }
}
