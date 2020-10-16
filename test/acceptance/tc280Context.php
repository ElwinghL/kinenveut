<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc280Context implements Context
{
  /**
   * @When l'utilisateur choisit une visibilité
   */
  public function lutilisateurChoisitUneVisibilite()
  {
    throw new PendingException();
  }

  /**
   * @Then le résultat de sa recherche est affiché
   */
  public function leResultatDeSaRechercheEstAffiche()
  {
    throw new PendingException();
  }
}
