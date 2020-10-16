<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc63Context implements Context
{
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
