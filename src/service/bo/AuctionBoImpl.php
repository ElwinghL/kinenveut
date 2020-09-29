<?php

class AuctionBoImpl implements IAuctionBo
{
    public function insertAuction(AuctionModel $auction)
    {
        $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
        $success = $auctionDao->insertAuction($auction);

        return $success;
    }

    public function selectAllAuctions()
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctions = $auctionDao->selectAllAuctions();

    return $auctions;
  }
}
