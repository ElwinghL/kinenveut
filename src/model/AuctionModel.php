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
  private $auctionState; //(null: attente d'acceptation, 0: EnchèreEnCours, 1: Annulée)
  private $sellerId;
  private $privacyId;
  private $categoryId;

  private $bestBid;

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

  public function setName($name): AuctionModel
  {
    $this->name = $name;

    return $this;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description): AuctionModel
  {
    $this->description = $description;

    return $this;
  }

  public function getBasePrice()
  {
    return $this->basePrice;
  }

  public function setBasePrice($basePrice): AuctionModel
  {
    $this->basePrice = $basePrice;

    return $this;
  }

  public function getReservePrice()
  {
    return $this->reservePrice;
  }

  public function setReservePrice($reservePrice): AuctionModel
  {
    $this->reservePrice = $reservePrice;

    return $this;
  }

  public function getPictureLink()
  {
    return $this->pictureLink;
  }

  public function setPictureLink($pictureLink): AuctionModel
  {
    $this->pictureLink = $pictureLink;

    return $this;
  }

  public function getStartDate()
  {
    return $this->startDate;
  }

  public function setStartDate($startDate): AuctionModel
  {
    $this->startDate = $startDate;

    return $this;
  }

  public function getDuration()
  {
    return $this->duration;
  }

  public function setDuration($duration): AuctionModel
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

  public function setPrivacyId($privacyId): AuctionModel
  {
    $this->privacyId = $privacyId;

    return $this;
  }

  public function getCategoryId()
  {
    return $this->categoryId;
  }

  public function setCategoryId($categoryId): AuctionModel
  {
    $this->categoryId = $categoryId;

    return $this;
  }

  public function getBestBid()
  {
    return $this->bestBid;
  }

  public function setBestBid(BidModel $bestBid): AuctionModel
  {
    $this->bestBid = $bestBid;

    return $this;
  }
}
