<?php

class BidHistoryBoImpl implements IBidHistoryBo
{
  public function insertBid(BidModel $bid): ?int
  {
    $bidHistoryDao = App_DaoFactory::getFactory()->getBidHistoryDao();
    $bidId = $bidHistoryDao->insertBid($bid);

    return $bidId;
  }

  public function deleteBidById(int $bidId): bool
  {
    $bidHistoryDao = App_DaoFactory::getFactory()->getBidHistoryDao();
    $success = $bidHistoryDao->deleteBidById($bidId);

    return $success;
  }
}
