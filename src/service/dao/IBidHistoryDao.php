<?php

interface IBidHistoryDao
{
  public function insertBid(BidModel $bid): ?int;

  public function deleteBidById(int $bidId): bool;

  public function deleteCurrentBidsByBidderId(int $bidderId) : bool;
}
