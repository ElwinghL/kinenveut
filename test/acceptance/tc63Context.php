<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc63Context implements Context
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
   * @When les données de l'enchère sont invalides
   */
  public function lesDonneesDeLenchereSontInvalides()
  {
    throw new PendingException();
  }

  /**
   * @Then l'enchère n'est pas créée
   */
  public function lenchereNestPasCreee()
  {
    throw new PendingException();
  }
}
