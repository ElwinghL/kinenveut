<?php

interface IAuctionDao
{
  public function insertAuction(AuctionModel $auction): ?int;

  public function updateStartDateAndAuctionState(AuctionModel $auction): bool;

  public function updateAuctionState(AuctionModel $auction): bool;

  public function deleteAuctionById(int $auctionId): bool;

  public function selectAuctionByAuctionId(int $auctionId): ?AuctionModel;

  public function selectAllAuctionsByAuctionState(int $auctionState): array;

  public function selectAllAuctionsBySellerId(int $userId): array;

  public function selectAcceptedConfidentialAuctionsByBidderId(int $userId): array;

  public function selectAllAuctionsByBidderId(int $bidderId) : array;
}
