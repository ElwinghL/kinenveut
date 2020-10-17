<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc54Context implements Context
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
   * @When Qu'il valide la confirmation
   */
  public function quilValideLaConfirmation()
  {
    throw new PendingException();
  }

  /**
   * @Then Son compte est supprimé
   */
  public function sonCompteEstSupprime()
  {
    throw new PendingException();
  }
}
