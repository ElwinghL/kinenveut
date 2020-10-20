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
    visitAuctionManagement($session);
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
