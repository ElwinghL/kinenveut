<?php

interface IAuctionBo
{
  public function selectAllAuctionsByAuctionState(int $auctionState) : array;

  public function insertAuction(AuctionModel $auction);

  //public function selectAllAuctions();
}
