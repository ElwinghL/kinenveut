<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc275Context implements Context
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
   * @When L'utilisateur veux récupérer ses données banquaires.
   */
  public function lutilisateurVeuxRecupererSesDonneesBanquaires()
  {
    throw new PendingException();
  }

  /**
   * @Then Le données banquaires sont chiffrées.
   */
  public function leDonneesBanquairesSontChiffrees()
  {
    throw new PendingException();
  }
}
