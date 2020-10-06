<?php

class AuctionAccessStateModel
{
  private $id;
  private $auction;
  private $bidder;
  private $stateId;

  public function getId() : ?int
  {
    return $this->id;
  }

  public function setId($id): AuctionAccessStateModel
  {
    $this->id = $id;

    return $this;
  }

  public function getAuction() : ?AuctionModel
  {
    return $this->auction;
  }

  public function setAuction($auction): AuctionAccessStateModel
  {
    $this->auction = $auction;

    return $this;
  }

  public function getBidder() : ?UserModel
  {
    return $this->bidder;
  }

  public function setBidder($bidder): AuctionAccessStateModel
  {
    $this->bidder = $bidder;

    return $this;
  }

  public function getStateId() : ?int
  {
    return $this->stateId;
  }

  public function setStateId($stateId): AuctionAccessStateModel
  {
    $this->stateId = $stateId;

    return $this;
  }
}
