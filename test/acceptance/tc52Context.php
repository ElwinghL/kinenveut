<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc52Context implements Context
{
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
