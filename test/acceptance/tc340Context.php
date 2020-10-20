<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc340Context implements Context
{
  /**
   * @When l'utilisateur arrive sur la page d'une enchère
   */
  public function lutilisateurArriveSurLaPageDuneEnchere()
  {
    $session = Universe::getUniverse()->getSession();

    $url = 'kinenveut/?r=bid/index&auctionId=' . Universe::getUniverse()->getAuction()->getId();
    $session->visit($url);

    checkUrl($url);
  }

  /**
   * @Then l'utilisateur visualise les données de la dernière enchère effectuée
   */
  public function lutilisateurVisualiseLesDonneesDeLaDerniereEnchereEffectuee()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      'h2'
    )->getText() != Universe::getUniverse()->getAuction()->getName() . ' - 42€') {
      throw new Exception('bid is not valid');
    };
  }
}
