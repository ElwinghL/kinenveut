<?php

interface IAuctionAccessStateBo
{
  public function insertAuctionAccessState(AuctionAccessStateModel $auctionAccessState) : ?int;

  public function deleteAuctionAccessStateById(int $categoryId) : bool;

  public function updateStateId(int $auctionAccessStateId, int $stateId) : bool;

  public function selectAllAuctionAccessStateBySellerIdAndStateId(int $sellerId, int $stateId) : array;
}
