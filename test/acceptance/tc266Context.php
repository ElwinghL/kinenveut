<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc266Context implements Context
{
  /**
   * @Then la liste des enchères est visible
   */
  public function laListeDesEncheresEstVisible()
  {
    throw new PendingException();
  }
}
