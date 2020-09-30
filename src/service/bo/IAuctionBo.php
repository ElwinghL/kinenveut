<?php

interface IAuctionBo
{
  public function getAllAuctionsByAuctionState(int $auctionState) : array;

  public function insertAuction(AuctionModel $auction);

  //public function selectAllAuctions();
}
