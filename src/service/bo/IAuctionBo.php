<?php

interface IAuctionBo
{
  public function selectAllAuctionsByAuctionState(int $auctionState) : array;

  public function selectAuctionByAuctionId(int $auctionId) : ?AuctionModel;

  public function selectAllAuctionsBySellerId(int $userId) : array;

  public function insertAuction(AuctionModel $auction) : ?int;

  public function updateStartDateAndAuctionState(AuctionModel $auction): bool;

  public function updateAuctionState(AuctionModel $auction): bool;

  public function deleteAuctionById(int $auctionId) : bool;
}
