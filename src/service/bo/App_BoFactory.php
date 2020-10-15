<?php

class App_BoFactory
{
  private static $_instance;

  public static function setFactory(?App_BoFactory $f)
  {
    self::$_instance = $f;
  }

  public static function getFactory(): App_BoFactory
  {
    if (!self::$_instance) {
      self::$_instance = new self;
    }

    return self::$_instance;
  }

  public function getUserBo(): UserBoImpl
  {
    return new UserBoImpl();
  }

  public function getAuctionBo(): AuctionBoImpl
  {
    return new AuctionBoImpl();
  }

  public function getAuctionAccessStateBoImplBo(): AuctionAccessStateBoImpl
  {
    return new AuctionAccessStateBoImpl();
  }

  public function getCategoryBo(): CategoryBoImpl
  {
    return new CategoryBoImpl();
  }

  public function getBidHistoryBo(): BidHistoryBoImpl
  {
    return new BidHistoryBoImpl();
  }

  public function getAuctionAccessStateBo(): AuctionAccessStateBoImpl
  {
    return new AuctionAccessStateBoImpl();
  }
}
