<?php

class AuctionAccessStateBoImpl implements IAuctionAccessStateBo
{
  public function insertAuctionAccessState(int $auctionId, int $bidderId): ?int
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);

    return $auctionId;
  }

  public function deleteAuctionAccessStateById(int $categoryId): bool
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $success = $auctionAccessStateDao->deleteAuctionAccessStateById($categoryId);

    return $success;
  }

  public function updateStateIdByAuctionAccessStateId(int $auctionAccessStateId, int $stateId): bool
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $isUpdated = $auctionAccessStateDao->updateStateIdByAuctionAccessStateId($auctionAccessStateId, $stateId);

    return $isUpdated;
  }

  public function updateStateIdByAuctionIdAndBidderId(int $auctionId, int $bidderId, int $stateId)  : bool
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $isUpdated = $auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, $stateId);

    return $isUpdated;
  }

  public function selectAllAuctionAccessStateBySellerIdAndStateId(int $sellerId, int $stateId): array
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionAccessStateList = $auctionAccessStateDao->selectAllAuctionAccessStateBySellerIdAndStateId($sellerId, $stateId);

    return $auctionAccessStateList;
  }
}
