<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc266Context implements Context
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
  }

  /**
   * @When l'utilisateur consulte la liste des enchères
   */
  public function lutilisateurConsulteLaListeDesEncheres()
  {
    $session = Universe::getUniverse()->getSession();
    $session->visit('http://localhost/kinenveut/?r=auctionManagement');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=auctionManagement') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=auctionManagement"');
    }
  }

  /**
   * @Then la liste des enchères est visible
   */
  public function laListeDesEncheresEstVisible()
  {
    throw new PendingException();
  }
}
