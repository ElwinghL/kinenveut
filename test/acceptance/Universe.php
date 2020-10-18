<?php

class Universe
{
  private static $_instance;
  private static $session;
  private $user;
  private $user2;
  private $user3;
  private $auction;
  private $auctionId;
  private $canDelete;

  public static function getUniverse(): Universe
  {
    if (!self::$_instance) {
      self::$_instance = new self;
      self::init();
    }

    return self::$_instance;
  }

  private static function init()
  {
    $driver = new \Behat\Mink\Driver\GoutteDriver();
    self::$session = new \Behat\Mink\Session($driver);
  }

  public function getSession() : \Behat\Mink\Session
  {
    return self::$session;
  }

  public function getUser() : ?UserModel
  {
    return $this->user;
  }

  public function setUser(?UserModel $user) : Universe
  {
    $this->user = $user;

    return $this;
  }

  public function getUser2() : ?UserModel
  {
    return $this->user2;
  }

  public function setUser2(?UserModel $user2) : Universe
  {
    $this->user2 = $user2;

    return $this;
  }

  public function getUser3() : ?UserModel
  {
    return $this->user3;
  }

  public function setUser3(?UserModel $user) : Universe
  {
    $this->user3 = $user;

    return $this;
  }

  public function getAuction() : ?AuctionModel
  {
    return $this->auction;
  }

  public function setAuction(?AuctionModel $auction) : Universe
  {
    $this->auction = $auction;

    return $this;
  }

  public function getAuctionId() : ?int
  {
    return $this->auctionId;
  }

  public function setAuctionId(?int $auctionId) : Universe
  {
    $this->auctionId = $auctionId;

    return $this;
  }

  public function setCanDelete(?array $canDelete):void
  {
    $this->canDelete = $canDelete;
  }

  public function getCanDelete() : ?array
  {
    return $this->canDelete;
  }
}
