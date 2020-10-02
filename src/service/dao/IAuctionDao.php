<?php

interface IAuctionDao
{
  public function selectAllAuctionsByAuctionState(int $auctionState) : array;

  public function insertAuction(AuctionModel $auction): ?int;

  public function deleteAuctionById(int $auctionId) : bool;
}
