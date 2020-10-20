<?php

use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc280Context implements Context
{
  /**
   * @When l'utilisateur choisit une visibilité
   */
  public function lutilisateurChoisitUneVisibilite()
  {
    $session = Universe::getUniverse()->getSession();

    $session->getPage()->find(
      'css',
      '#privacyId'
    )->selectOption(1);
  }

  /**
   * @Then le résultat de sa recherche est affiché
   */
  public function leResultatDeSaRechercheEstAffiche()
  {
    //Todo : Atention, on ne sait pas s'il existe ou non des enchères :)
    $session = Universe::getUniverse()->getSession();

    $url = 'kinenveut/?r=home/search';
    checkUrl($url);

    if ($session->getPage()->find(
      'css',
      '.auctions-list-custom'
    ) == false) {
      throw new Exception('The auction list was not found');
    }

  }
}
