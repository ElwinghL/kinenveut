<?php

use Behat\Behat\Context\Context;

include_once 'tools.php';
/**
 * Defines application features from the specific context.
 */
class tc51Context implements Context
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
   * @Then la liste des enchères publiques est visible
   */
  public function laListeDesEncheresPubliquesEstVisible()
  {
    $session = Universe::getUniverse()->getSession();

    visitCreateAuction($session);

    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette');
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();

    visitAuctionManagement($session);

    if ($session->getPage()->find(
      'css',
      'h2'
    )->getText() != 'Liste des enchères') {
      throw new Exception('the auction validation page is not displayed');
    }
    if ($session->getPage()->find(
      'css',
      '.privacy0'
    )->getText() != 'Chaussette') {
      throw new Exception('public auction was not found');
    }
  }

  /**
   * @Then la liste des enchères privées est visible
   */
  public function laListeDesEncheresPriveesEstVisible()
  {
    $session = Universe::getUniverse()->getSession();

    visitCreateAuction($session);

    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette');
    $session->getPage()->find(
      'css',
      '#privacyId'
    )->selectOption(1);
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();

    visitAuctionManagement($session);

    if ($session->getPage()->find(
      'css',
      'h2'
    )->getText() != 'Liste des enchères') {
      throw new Exception('the auction validation page is not displayed');
    }
    if ($session->getPage()->find(
      'css',
      '.privacy1'
    )->getText() != 'Chaussette') {
      throw new Exception('private auction was not found');
    }
  }

  /**
   * @Then la liste des enchères confidentielles est visible
   */
  public function laListeDesEncheresConfidentiellesEstVisible()
  {
    $session = Universe::getUniverse()->getSession();

    visitCreateAuction($session);

    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette');
    $session->getPage()->find(
      'css',
      '#privacyId'
    )->selectOption(2);
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();

    visitAuctionManagement($session);

    if ($session->getPage()->find(
      'css',
      'h2'
    )->getText() != 'Liste des enchères') {
      throw new Exception('the auction validation page is not displayed');
    }
    if ($session->getPage()->find(
      'css',
      '.privacy2'
    )->getText() != 'Chaussette') {
      throw new Exception('confidential auction was not found');
    }

    $sellers = [Universe::getUniverse()->getUser()];
    Universe::getUniverse()->setCanDelete(['user'=>true, 'auctions'=>$sellers]);
  }
}
