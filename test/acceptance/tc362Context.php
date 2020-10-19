<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc362Context implements Context
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

  public function __destruct()
  {
  }

  /**
   * @Given une demande d'inscription est présente
   */
  public function uneDemandeDinscriptionEstPresente()
  {
    throw new PendingException();
  }

  /**
   * @When l'admin valide l'inscription
   */
  public function ladminValideLinscription()
  {
    throw new PendingException();
  }

  /**
   * @Then l'inscription de l'utilisateur devient effective
   */
  public function linscriptionDeLutilisateurDevientEffective()
  {
    throw new PendingException();
  }
}
