<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc32Context implements Context
{
  /**
   * @When l'utilisateur choisis une catégorie
   */
  public function lutilisateurChoisisUneCategorie()
  {
    throw new PendingException();
  }
}
