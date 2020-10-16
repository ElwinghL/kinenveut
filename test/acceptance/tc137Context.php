<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc137Context implements Context
{
  /**
   * @Given l'utilisateur participe à des enchères.
   */
  public function lutilisateurParticipeADesEncheres()
  {
    throw new PendingException();
  }

  /**
   * @When L'utilisateur consulte les enchères auxquelles il participe.
   */
  public function lutilisateurConsulteLesEncheresAuxquellesIlParticipe()
  {
    throw new PendingException();
  }

  /**
   * @Then L'utilisateur voit les enchères auxquelles il participe.
   */
  public function lutilisateurVoitLesEncheresAuxquellesIlParticipe()
  {
    throw new PendingException();
  }
}
