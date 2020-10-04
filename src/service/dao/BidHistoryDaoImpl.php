<?php

class BidHistoryDaoImpl implements IBidHistoryDao
{
  public function insertBid(BidModel $bid): ?int
  {
    $request = db()->prepare('INSERT INTO BidHistory(bidPrice, bidDate, objectId, bidderID) VALUES (?,?,?,?)');
    $request->execute([$bid->getBidPrice(), $bid->getBidDate(), $bid->getObjectId(), $bid->getBidderId()]);

    return db()->lastInsertId();
  }

  public function deleteBidById(int $bidId): bool
  {
    $request = db()->prepare('DELETE FROM BidHistory WHERE id=?');
    $success = $request->execute([$bidId]);

    return $success;
  }
}
