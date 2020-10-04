<?php

interface IBidHistoryDao
{
  public function insertBid(BidModel $bid): ?int;

  public function deleteBidById(int $bidId) : bool;
}
