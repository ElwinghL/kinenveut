<?php

class BidModel
{
  private $id;
  private $bidPrice;
  private $bidDate;
  private $objectId;
  private $bidderId;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id): BidModel
  {
    $this->id = $id;

    return $this;
  }

  public function getBidPrice()
  {
    return $this->bidPrice;
  }

  public function setBidPrice($bidPrice): BidModel
  {
    $this->bidPrice = $bidPrice;

    return $this;
  }

  public function getBidDate()
  {
    return $this->bidDate;
  }

  public function setBidDate($bidDate): BidModel
  {
    $this->bidDate = $bidDate;

    return $this;
  }

  public function getBidderId()
  {
    return $this->bidderId;
  }

  public function setBidderId($bidderId): BidModel
  {
    $this->bidderId = $bidderId;

    return $this;
  }

  public function getObjectId()
  {
    return $this->objectId;
  }

  public function setObjectId($objectId): BidModel
  {
    $this->objectId = $objectId;

    return $this;
  }
}
