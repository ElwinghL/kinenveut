<?php

class AuctionAccessStateModel
{
  private $id;
  private $auction;
  private $bidder;
  private $stateId;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function setId(?int $id): AuctionAccessStateModel
  {
    $this->id = $id;

    return $this;
  }

  public function getAuction(): AuctionModel
  {
    $this->auction = ($this->auction == null) ? new AuctionModel() : $this->auction;

    return $this->auction;
  }

  public function setAuction(?AuctionModel $auction): AuctionAccessStateModel
  {
    $this->auction = $auction;

    return $this;
  }

  public function getBidder(): UserModel
  {
    $this->bidder = ($this->bidder == null) ? new UserModel() : $this->bidder;

    return $this->bidder;
  }

  public function setBidder(?UserModel $bidder): AuctionAccessStateModel
  {
    $this->bidder = $bidder;

    return $this;
  }

  public function getStateId(): ?int
  {
    return $this->stateId;
  }

  public function setStateId(?int $stateId): AuctionAccessStateModel
  {
    $this->stateId = $stateId;

    return $this;
  }
}
