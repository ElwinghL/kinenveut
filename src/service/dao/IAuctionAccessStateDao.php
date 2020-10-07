<?php

interface IAuctionAccessStateDao
{
  public function insertAuctionAccessState(int $auctionId, int $bidderId) : ?int;

  public function deleteAuctionAccessStateById(int $categoryId) : bool;

  public function updateStateIdByAuctionAccessStateId(int $auctionAccessStateId, int $stateId) : bool;

  public function updateStateIdByAuctionIdAndBidderId(int $auctionId, int $bidderId, int $stateId)  : bool;

  public function selectAllAuctionAccessStateBySellerIdAndStateId(int $sellerId, int $stateId) : array;
}
