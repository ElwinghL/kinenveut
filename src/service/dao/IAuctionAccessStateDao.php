<?php

interface IAuctionAccessStateDao
{
  public function insertAuctionAccessState(int $auctionId, int $bidderId) : ?int;

  public function deleteAuctionAccessStateById(int $categoryId) : bool;

  public function updateStateId(int $auctionAccessStateId, int $stateId) : bool;

  public function selectAllAuctionAccessStateBySellerIdAndStateId(int $sellerId, int $stateId) : array;
}
