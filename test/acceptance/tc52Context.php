<?php

use Behat\Behat\Context\Context;

include_once 'tools.php';

/**
 * Defines application features from the specific context.
 */
class tc52Context implements Context
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
    deleteAuctionUniverse();
    deleteUserUniverse();
  }

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
    $session = Universe::getUniverse()->getSession();
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=home') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=home"');
    }

    $sellers = [Universe::getUniverse()->getUser()];
    Universe::getUniverse()->setCanDelete(['user'=>true, 'auctions'=>$sellers]);
  }
}
