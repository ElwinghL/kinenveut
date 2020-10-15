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
  private $endDate;
  private $auctionState;
  private $sellerId;
  private $privacyId;
  private $categoryId;

  private $bestBid;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function setId(?int $id): AuctionModel
  {
    $this->id = $id;

    return $this;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(?string $name): AuctionModel
  {
    $this->name = $name;

    return $this;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function setDescription(?string $description): AuctionModel
  {
    $this->description = $description;

    return $this;
  }

  public function getBasePrice(): ?int
  {
    return $this->basePrice;
  }

  public function setBasePrice(?int $basePrice): AuctionModel
  {
    $this->basePrice = $basePrice;

    return $this;
  }

  public function getReservePrice(): ?int
  {
    return $this->reservePrice;
  }

  public function setReservePrice(?int $reservePrice): AuctionModel
  {
    $this->reservePrice = $reservePrice;

    return $this;
  }

  public function getPictureLink(): ?string
  {
    return $this->pictureLink;
  }

  public function setPictureLink(?string $pictureLink): AuctionModel
  {
    $this->pictureLink = $pictureLink;

    return $this;
  }

  public function getStartDate() : ?DateTime
  {
    return $this->startDate;
  }

  public function setStartDate(?DateTime $startDate): AuctionModel
  {
    $this->startDate = $startDate;

    return $this;
  }

  public function getDuration(): ?int
  {
    return $this->duration;
  }

  public function setDuration(?int $duration): AuctionModel
  {
    $this->duration = $duration;

    return $this;
  }

  public function getEndDate() : ?DateTime
  {
    return $this->endDate;
  }

  public function setEndDate(?DateTime $endDate): AuctionModel
  {
    $this->endDate = $endDate;

    return $this;
  }

  public function getAuctionState(): ?int
  {
    return $this->auctionState;
  }

  public function setAuctionState(?int $auctionState): AuctionModel
  {
    $this->auctionState = $auctionState;

    return $this;
  }

  public function getSellerId(): ?int
  {
    return $this->sellerId;
  }

  public function setSellerId(?int $sellerId): AuctionModel
  {
    $this->sellerId = $sellerId;

    return $this;
  }

  public function getPrivacyId(): ?int
  {
    return $this->privacyId;
  }

  public function setPrivacyId(?int $privacyId): AuctionModel
  {
    $this->privacyId = $privacyId;

    return $this;
  }

  public function getCategoryId(): ?int
  {
    return $this->categoryId;
  }

  public function setCategoryId(?int $categoryId): AuctionModel
  {
    $this->categoryId = $categoryId;

    return $this;
  }

  public function getBestBid(): ?BidModel
  {
    return $this->bestBid;
  }

  public function setBestBid(?BidModel $bestBid): AuctionModel
  {
    $this->bestBid = $bestBid;

    return $this;
  }
}
