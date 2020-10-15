<?php

class BidModel
{
  private $id;
  private $bidPrice;
  private $bidDate;
  private $objectId;
  private $bidderId;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function setId(?int $id): BidModel
  {
    $this->id = $id;

    return $this;
  }

  public function getBidPrice(): ?int
  {
    return $this->bidPrice;
  }

  public function setBidPrice(?int $bidPrice): BidModel
  {
    $this->bidPrice = $bidPrice;

    return $this;
  }

  public function getBidDate() : ?DateTime
  {
      return $this->bidDate;
  }

  public function setBidDate(?DateTime $bidDate): BidModel
  {
    $this->bidDate = $bidDate;

    return $this;
  }

  public function getBidderId(): ?int
  {
    return $this->bidderId;
  }

  public function setBidderId(?int $bidderId): BidModel
  {
    $this->bidderId = $bidderId;

    return $this;
  }

  public function getObjectId(): ?int
  {
    return $this->objectId;
  }

  public function setObjectId(?int $objectId): BidModel
  {
    $this->objectId = $objectId;

    return $this;
  }
}
