<?php

class AuctionBoImpl implements IAuctionBo
{
  public function selectAllAuctionsByAuctionState(int $auctionState) : array
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionList = $auctionDao->selectAllAuctionsByAuctionState($auctionState);

    return $auctionList;
  }

  public function selectAuctionByAuctionId(int $auctionId): AuctionModel
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionSelected = $auctionDao->selectAuctionByAuctionId($auctionId);

    return $auctionSelected;
  }

  public function selectAllAuctionsBySellerId(int $userId): array
    {
        $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
        $auctionList = $auctionDao->selectAllAuctionsBySellerId($userId);

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

  public function updateStartDateAndAuctionState(AuctionModel $auction): bool
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $isUpdated = $auctionDao->updateStartDateAndAuctionState($auction);

    return $isUpdated;
  }

    public function updateAuctionState(AuctionModel $auction): bool
    {
        $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
        $isUpdated = $auctionDao->updateAuctionState($auction);

        return $isUpdated;
    }
}
