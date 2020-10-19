<?php

use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc266Context implements Context
{
  /**
   * @When l'utilisateur consulte la liste des enchères
   */
  public function lutilisateurConsulteLaListeDesEncheres()
  {
    $session = Universe::getUniverse()->getSession();
    visitAuctionManagement($session);
  }

  /**
   * @Then la liste des enchères est visible
   */
  public function laListeDesEncheresEstVisible()
  {
    $session = Universe::getUniverse()->getSession();
    if ($session->getPage()->find(
      'css',
      '#waitingList'
    ) == false) {
      throw new Exception('The waiting list was not found');
    }

    if ($session->getPage()->find(
      'css',
      '#waitingList li'
    ) == false) {
      throw new Exception('The waiting list is empty');
    }
  }
}
