<?php

class AuctionModel
{
  private $id;
  private $name;
  private $description;
  private $basePrice;
  private $reservePrice;
  private $pictureLink;
  private $startDate;
  private $duration;
  private $auctionState;
  private $sellerId;
  private $privacyId;
  private $categoryId;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id): AuctionModel
  {
    $this->id = $id;
      return $this;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
      return $this;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;
      return $this;
  }

  public function getBasePrice()
  {
    return $this->basePrice;
  }

  public function setBasePrice($basePrice)
  {
    $this->basePrice = $basePrice;
      return $this;
  }

  public function getReservePrice()
  {
    return $this->reservePrice;
  }

  public function setReservePrice($reservePrice)
  {
    $this->reservePrice = $reservePrice;
      return $this;
  }

  public function getPictureLink()
  {
    return $this->pictureLink;
  }

  public function setPictureLink($pictureLink)
  {
    $this->pictureLink = $pictureLink;
      return $this;
  }

  public function getStartDate()
  {
    return $this->startDate;
  }

  public function setStartDate($startDate)
  {
    $this->startDate = $startDate;
      return $this;
  }

  public function getDuration()
  {
    return $this->duration;
  }

  public function setDuration($duration)
  {
    $this->duration = $duration;
      return $this;
  }

  public function getAuctionState()
  {
    return $this->auctionState;
  }

  public function setAuctionState($auctionState): AuctionModel
  {
    $this->auctionState = $auctionState;
      return $this;
  }

  public function getSellerId()
  {
    return $this->sellerId;
  }

  public function setSellerId($sellerId): AuctionModel
  {
    $this->sellerId = $sellerId;
      return $this;
  }

  public function getPrivacyId()
  {
    return $this->privacyId;
  }

  public function setPrivacyId($privacyId)
  {
    $this->privacyId = $privacyId;
      return $this;
  }

  public function getCategoryId()
  {
    return $this->categoryId;
  }

  public function setCategoryId($categoryId)
  {
    $this->categoryId = $categoryId;
      return $this;
  }
}
