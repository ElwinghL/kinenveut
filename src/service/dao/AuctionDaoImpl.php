<?php

class AuctionDaoImpl implements IAuctionDao
{
  public function insertAuction(AuctionModel $auction)
  {
    $request = db()->prepare("INSERT INTO Objects(name, description, basePrice, reservePrice, pictureLink, startDate, duration, auctionState, sellerId, privacyId, categoryId) VALUES (?, ?, ?, ?, ' ', ?, ?, 0, ?, ?, ?)");

    return $request->execute([$auction->getName(), $auction->getDescription(), $auction->getBasePrice(), $auction->getReservePrice(), /*$auction->getPictureLink(),*/ $auction->getStartDate(), $auction->getDuration(), $auction->getSellerId(), $auction->getPrivacyId(), $auction->getCategoryId()]);
  }
}
