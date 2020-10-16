<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc52Context implements Context
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
   * @When l'utilisateur valide son enchère
   */
  public function lutilisateurValideSonEnchere()
  {
    throw new PendingException();
  }

  /**
   * @When les données de l'enchère sont valides
   */
  public function lesDonneesDeLenchereSontValides()
  {
    throw new PendingException();
  }

  /**
   * @Then une enchère est créée
   */
  public function uneEnchereEstCreee()
  {
    throw new PendingException();
  }
}
