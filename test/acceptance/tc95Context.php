<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc95Context implements Context
{
  /**
   * @When l'utilisateur consulte la liste de catégories
   */
  public function lutilisateurConsulteLaListeDeCategories()
  {
    $session = Universe::getUniverse()->getSession();
    $session->visit($_ENV['adresse'] . '?r=auctionManagement');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== $_ENV['adresse'] . '?r=auctionManagement') {
      throw new Exception('url is not ' . $_ENV['adresse'] . '?r=auctionManagement"');
    }
  }

  /**
   * @Then la liste des catégories est visible
   */
  public function laListeDesCategoriesEstVisible()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      'h2'
    )->getText() != 'Liste des enchères') {
      throw new Exception('the list of categories page is not displayed');
    }
  }
}
