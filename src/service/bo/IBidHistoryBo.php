<?php

interface IBidHistoryBo
{
  public function insertBid(BidModel $bid): ?int;

  public function deleteBidById(int $bidId): bool;
}
