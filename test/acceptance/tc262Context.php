<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc262Context implements Context
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
