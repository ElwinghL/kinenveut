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
    Universe::getUniverse()->setUser(null);
  }
}
