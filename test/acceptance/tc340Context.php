<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc340Context implements Context
{
  /**
   * @Given l'utilisateur connecté sur le site
   */
  public function lutilisateurConnecteSurLeSite()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur arrive sur la page d'une enchère
   */
  public function lutilisateurArriveSurLaPageDuneEnchere()
  {
    throw new PendingException();
  }

  /**
   * @Then l'utilisateur visualise les données de la dernière enchère effectuée
   */
  public function lutilisateurVisualiseLesDonneesDeLaDerniereEnchereEffectuee()
  {
    throw new PendingException();
  }
}
