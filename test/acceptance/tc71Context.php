<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc71Context implements Context
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
   * @When l'utilisateur tape le nom de son objet dans la barre de recherche
   */
  public function lutilisateurTapeLeNomDeSonObjetDansLaBarreDeRecherche()
  {
    $session = Universe::getUniverse()->getSession();
    $auction = Universe::getUniverse()->getAuction();

    $session->getPage()->find(
      'css',
      'input[name="searchInput"]'
    )->setValue($auction->getName());
  }
}
