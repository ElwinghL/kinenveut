<?php

class App_BoFactory
{
  private static $_instance;

  public static function setFactory(App_BoFactory $f)
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

  public function getUserBo()
  {
    return new UserBoImpl();
  }

  public function getAuctionBo()
  {
    return new AuctionBoImpl();
  }

  public function getCategoryBo()
  {
    return new CategoryBoImpl();
  }
}
