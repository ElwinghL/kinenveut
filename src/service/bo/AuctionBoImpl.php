<?php

class AuctionBoImpl implements IAuctionBo
{
  public function selectAllAuctionsByAuctionState(int $auctionState) : array
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionList = $auctionDao->selectAllAuctionsByAuctionState($auctionState);

    return $auctionList;
  }

  public function insertAuction(AuctionModel $auction)
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $success = $auctionDao->insertAuction($auction);

    return $success;
  }

  /*public function selectAllAuctions()
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctions = $auctionDao->selectAllAuctions();

    return $auctions;
  }*/
}
