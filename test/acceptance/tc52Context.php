<?php

use Behat\Behat\Context\Context;

include_once 'tools.php';

/**
 * Defines application features from the specific context.
 */
class tc52Context implements Context
{
  /**
   * @Given l'utilisateur est sur la page de création d'enchère
   */
  public function lutilisateurEstSurLaPageDeCreationDenchere()
  {
    $session = Universe::getUniverse()->getSession();

    visitCreateAuction($session);
  }

  /**
   * @When l'utilisateur valide son enchère avec les champs valides
   */
  public function lutilisateurValideSonEnchereAvecLesChampsValides()
  {
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette');
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();
  }

  /**
   * @Then une enchère est créée
   */
  public function uneEnchereEstCreee()
  {
    checkUrl('kinenveut/?r=home');
  }
}
