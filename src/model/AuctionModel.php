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
  private $endDate;
  private $auctionState; //(null: attente d'acceptation, 0: EnchèreEnCours, 1: Annulée)
  private $sellerId;
  private $privacyId;
  private $categoryId;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id): void
  {
    $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function getBasePrice()
  {
    return $this->basePrice;
  }

  public function setBasePrice($basePrice)
  {
    $this->basePrice = $basePrice;
  }

  public function getReservePrice()
  {
    return $this->reservePrice;
  }

  public function setReservePrice($reservePrice)
  {
    $this->reservePrice = $reservePrice;
  }

  public function getPictureLink()
  {
    return $this->pictureLink;
  }

  public function setPictureLink($pictureLink)
  {
    $this->pictureLink = $pictureLink;
  }

  public function getStartDate()
  {
    return $this->startDate;
  }

  public function setStartDate($startDate)
  {
    $this->startDate = $startDate;
  }

  public function getEndDate()
  {
    return $this->endDate;
  }

  public function setEndDate($endDate)
  {
    $this->endDate = $endDate;
  }

  public function getAuctionState()
  {
    return $this->auctionState;
  }

  public function setAuctionState($auctionState): void
  {
    $this->auctionState = $auctionState;
  }

  public function getSellerId()
  {
    return $this->sellerId;
  }

  public function setSellerId($sellerId): void
  {
    $this->sellerId = $sellerId;
  }

  public function getPrivacyId()
  {
    return $this->privacyId;
  }

  public function setPrivacyId($privacyId)
  {
    $this->privacyId = $privacyId;
  }

  public function getCategoryId()
  {
    return $this->categoryId;
  }

  public function setCategoryId($categoryId)
  {
    $this->categoryId = $categoryId;
  }
}
