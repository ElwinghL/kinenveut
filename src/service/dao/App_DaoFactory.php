<?php

class App_DaoFactory
{
  private static $_instance;

  public static function setFactory(App_DaoFactory $f)
  {
    self::$_instance = $f;
  }

  public static function getFactory()
  {
    if (!self::$_instance) {
      self::$_instance = new self;
    }

    return self::$_instance;
  }

  public function getUserDao()
  {
    return new UserDaoImpl();
  }

  public function getAuctionDao()
  {
    return new AuctionDaoImpl();
  }

  public function getCategoryDao()
  {
    return new CategoryDaoImpl();
  }
}
