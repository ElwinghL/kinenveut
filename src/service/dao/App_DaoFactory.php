<?php

class App_DaoFactory
{
  private static $_instance;

  public static function setFactory(?App_DaoFactory $f)
  {
    self::$_instance = $f;
  }

  public static function getFactory(): App_DaoFactory
  {
    if (!self::$_instance) {
      self::$_instance = new self;
    }

    return self::$_instance;
  }

  public function getUserDao(): UserDaoImpl
  {
    return new UserDaoImpl();
  }

  public function getAuctionDao(): AuctionDaoImpl
  {
    return new AuctionDaoImpl();
  }

  public function getCategoryDao(): CategoryDaoImpl
  {
    return new CategoryDaoImpl();
  }

  public function getBidHistoryDao(): BidHistoryDaoImpl
  {
    return new BidHistoryDaoImpl();
  }

  public function getAuctionAccessStateDao(): AuctionAccessStateDaoImpl
  {
    return new AuctionAccessStateDaoImpl();
  }
}
