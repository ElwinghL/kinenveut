<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc38Context implements Context
{
  /**
   * @When l'utilisateur entre un prix de départ invalide
   */
  public function lutilisateurEntreUnPrixDeDepartInvalide()
  {
    throw new PendingException();
  }

  /**
   * @Then la création d'enchère est impossible
   */
  public function laCreationDenchereEstImpossible()
  {
    throw new PendingException();
  }
}
