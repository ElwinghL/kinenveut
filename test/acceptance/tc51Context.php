<?php

use Behat\Behat\Context\Context;
include_once "tools.php";
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
    $canDelete = Universe::getUniverse()->getCanDelete();
    if (isset($canDelete['auctions'])) {
      $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
      $userDao = App_DaoFactory::getFactory()->getUserDao();
      $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());
      if ($user != null) {
        $userAuctions = $auctionDao->selectAllAuctionsBySellerId($user->getId());
        foreach ($userAuctions as $auction) {
          $auctionDao->deleteAuctionById($auction->getId());
        }
      }
      unset($canDelete['auctions']);
    }
    if (isset($canDelete['user'])) {
      $userDao = App_DaoFactory::getFactory()->getUserDao();
      $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());
      if ($user != null) {
        $isAdmin = $user->getIsAdmin();
        if ($isAdmin == false) {
          $userDao->deleteUser($user->getId());
        }
      }
      unset($canDelete['user']);
    }
    Universe::getUniverse()->setCanDelete($canDelete);
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
    Universe::getUniverse()->setCanDelete(['user'=>true, 'auctions'=>true]);
  }
}
