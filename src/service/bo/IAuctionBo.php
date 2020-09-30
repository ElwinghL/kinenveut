<?php

interface IAuctionBo
{
    public function insertAuction(AuctionModel $auction);
    public function selectAllAuctions();
}