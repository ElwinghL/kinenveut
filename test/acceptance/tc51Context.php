<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

include_once 'tools.php';
/**
 * Defines application features from the specific context.
 */
class tc51Context implements Context
{
  /**
   * @Then la liste des enchères publiques est visible
   */
  public function laListeDesEncheresPubliquesEstVisible()
  {
    //todo :corriger la suppression dans la bdd
    throw new PendingException();
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
    //todo :corriger la suppression dans la bdd
    throw new PendingException();
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
    //todo :corriger la suppression dans la bdd
    throw new PendingException();
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
  }
}
