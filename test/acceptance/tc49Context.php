<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc49Context implements Context
{
  /**
   * @When l'utilisateur entre un prix de réserve invalide
   */
  public function lutilisateurEntreUnPrixDeReserveInvalide()
  {
    throw new PendingException();
  }
}
