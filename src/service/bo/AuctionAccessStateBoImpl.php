<?php

class AuctionAccessStateBoImpl implements IAuctionAccessStateBo
{
  public function insertAuctionAccessState(AuctionAccessStateModel $auctionAccessState): ?int
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionId = $auctionAccessStateDao->insertAuctionAccessState($auctionAccessState);

    return $auctionId;
  }

  public function deleteAuctionAccessStateById(int $categoryId): bool
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $success = $auctionAccessStateDao->deleteAuctionAccessStateById($categoryId);

    return $success;
  }

  public function updateStateId(int $auctionAccessStateId, int $stateId): bool
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $isUpdated = $auctionAccessStateDao->updateStateId($auctionAccessStateId, $stateId);

    return $isUpdated;
  }

  public function selectAllAuctionAccessStateBySellerIdAndStateId(int $sellerId, int $stateId): array
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionAccessStateList = $auctionAccessStateDao->selectAllAuctionAccessStateBySellerIdAndStateId($sellerId, $stateId);

    return $auctionAccessStateList;
  }
}
