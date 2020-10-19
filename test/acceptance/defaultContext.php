<?php

use Behat\Behat\Context\Context;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

/**
 * Defines application features from the specific context.
 */
class defaultContext implements Context
{
  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct()
  {
    Universe::getUniverse()->getSession()->restart();
  }

  public function __destruct()
  {
    Universe::getUniverse()->setUser(null);
    Universe::getUniverse()->setUser2(null);
    Universe::getUniverse()->setUser3(null);
    Universe::getUniverse()->setAuction(null);
  }
}
