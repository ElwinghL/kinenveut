<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc71Context implements Context
{
  /**
   * @When l'utilisateur tape le nom de son objet dans la barre de recherche
   */
  public function lutilisateurTapeLeNomDeSonObjetDansLaBarreDeRecherche()
  {
    throw new PendingException();
  }
}
