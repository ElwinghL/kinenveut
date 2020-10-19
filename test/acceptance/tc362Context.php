<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc362Context implements Context
{
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
