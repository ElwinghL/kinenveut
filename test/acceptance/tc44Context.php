<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc44Context implements Context
{
  /**
   * @When l'utilisateur entre un prix de réserve valide
   */
  public function lutilisateurEntreUnPrixDeReserveValide()
  {
    throw new PendingException();
  }
}
