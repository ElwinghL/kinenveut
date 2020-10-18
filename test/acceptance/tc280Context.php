<?php

use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc280Context implements Context
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
    deleteUserUniverse();
    deleteUser2Universe();
    deleteAuctionUniverse();
  }

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

    $url = 'http://localhost/kinenveut/?r=home/search';
    checkUrl($session, $url);

    if ($session->getPage()->find(
      'css',
      '.auctions-list-custom'
    ) == false) {
      throw new Exception('The auction list was not found');
    }

    Universe::getUniverse()->setCanDelete(['user' => true, 'auction' => true]);
  }
}
