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
    $session->visit($_ENV['path'] . $url);

    checkUrl($url);
  }

  /**
   * @Then l'utilisateur visualise les données de la dernière enchère effectuée
   */
  public function lutilisateurVisualiseLesDonneesDeLaDerniereEnchereEffectuee()
  {
    $session = Universe::getUniverse()->getSession();
    $auction = Universe::getUniverse()->getAuction();

    if ($session->getPage()->find(
      'css',
      'h2'
    )->getText() != $auction->getName() . ' - ' . $auction->getBestBid()->getBidPrice() . '€') {
      throw new Exception('bid is not valid');
    };
  }
}
