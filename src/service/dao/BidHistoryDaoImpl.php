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
    $request = 'DELETE FROM BidHistory WHERE id=?';

    $query = db()->prepare($request);

    return $query->execute([$bidId]);
  }
}
