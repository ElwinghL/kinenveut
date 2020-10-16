<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc280Context implements Context
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
