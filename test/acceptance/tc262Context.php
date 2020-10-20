<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc262Context implements Context
{
  /**
   * @When L'utilisateur clique sur le pseudo d'un utilisateur2.
   */
  public function lutilisateurCliqueSurLePseudoDunUtilisateur()
  {
    throw new PendingException();
  }

  /**
   * @Then L'utilisateur accède au profil de l'utilisateur2.
   */
  public function lutilisateurAccedeAuProfilDeLutilisateur()
  {
    throw new PendingException();
  }
}
