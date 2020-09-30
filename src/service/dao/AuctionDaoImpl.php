<?php

class AuctionDaoImpl implements IAuctionDao
{
  public function insertAuction(AuctionModel $auction)
  {
    $request = db()->prepare("INSERT INTO Objects(name, description, basePrice, reservePrice, pictureLink, startDate, endDate, isCancelled, sellerId, privacyId, categoryId) VALUES (?, ?, ?, ?, ' ', ?, ?, false, 2, ?, ?)");
    $success = $request->execute([$auction->getName(), $auction->getDescription(), $auction->getBasePrice(), $auction->getReservePrice(), $auction->getStartDate(), $auction->getEndDate(), $auction->getPrivacyId(), $auction->getCategoryId()]);

    return $success;
  }

  public function selectAllAuctions()
  {
    $request = db()->prepare('SELECT * FROM Objects');
    $request->execute();
    $auctions = $request->fetchAll();

    return $auctions;
  }
}
