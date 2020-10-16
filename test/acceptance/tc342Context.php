<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc342Context implements Context
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
   * @Given l'utilisateur est un administrateur de cette enchère
   */
  public function lutilisateurEstUnAdministrateurDeCetteEnchere()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur clique sur le bouton de clôture d'une enchère
   */
  public function lutilisateurCliqueSurLeBoutonDeClotureDuneEnchere()
  {
    throw new PendingException();
  }

  /**
   * @Then cette enchère est close
   */
  public function cetteEnchereEstClose()
  {
    throw new PendingException();
  }
}
