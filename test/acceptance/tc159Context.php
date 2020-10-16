<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc159Context implements Context
{
  /**
   * @Then l'utilisateur enchérit du montant choisi
   */
  public function lutilisateurEncheritDuMontantChoisi()
  {
    throw new PendingException();
  }
}
