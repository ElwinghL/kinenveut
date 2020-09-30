<?php

interface IAuctionDao
{
  public function insertAuction(AuctionModel $auction);

  public function selectAllAuctions();
}
