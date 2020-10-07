<?php

interface IAuctionAccessStateDao
{
  public function insertAuctionAccessState(int $auctionId, int $bidderId) : ?int;

  public function deleteAuctionAccessStateById(int $categoryId) : bool;

  public function updateStateIdByAuctionAccessStateId(int $auctionAccessStateId, int $stateId) : bool;

  public function updateStateIdByAuctionIdAndBidderId(int $auctionId, int $bidderId, int $stateId)  : bool;

  public function selectAuctionAccessStateByAuctionIdAndBidderId(int $auctionId, int $bidderId) : ?AuctionAccessStateModel;

  public function selectAllAuctionAccessStateBySellerIdAndStateId(int $sellerId, int $stateId) : array;

  public function selectNumberOfAuctionAccessStateBySellerId(int $sellerId) : int;
}
