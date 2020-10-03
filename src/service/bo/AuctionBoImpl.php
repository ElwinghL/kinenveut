<?php

class AuctionBoImpl implements IAuctionBo
{
  public function selectAllAuctionsByAuctionState(int $auctionState) : array
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionList = $auctionDao->selectAllAuctionsByAuctionState($auctionState);

    return $auctionList;
  }

  public function insertAuction(AuctionModel $auction) : ?int
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionId = $auctionDao->insertAuction($auction);

    return $auctionId;
  }

  public function deleteAuctionById(int $auctionId): bool
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $success = $auctionDao->deleteAuctionById($auctionId);

    return $success;
  }
}
