<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc106Context implements Context
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
   * @Given L'utilisateur est normal
   */
  public function lutilisateurEstNormal()
  {
    $user = new UserModel();
    $user
      ->setFirstName('Francis')
      ->setLastName('Dupont')
      ->setBirthDate(DateTime::createFromFormat('d/m/Y', '22/12/1999'))
      ->setEmail('francis.dupont@gmail.com')
      ->setPassword('password');

    Universe::getUniverse()->setUser($user);
  }

  /**
   * @Given L'utilisateur a posté des enchères.
   */
  public function lutilisateurAPosteDesEncheres()
  {
    $session = Universe::getUniverse()->getSession();

    visitCreateAuction($session);

    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette sale');
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();
  }

  /**
   * @When L'utilisateur consulte ses enchères.
   */
  public function lutilisateurConsulteSesEncheres()
  {
    $session = Universe::getUniverse()->getSession();

    visitSells($session);
  }

  /**
   * @Then L'utilisateur voit toutes les enchères qu'il a posté.
   */
  public function lutilisateurVoitToutesLesEncheresQuilAPoste()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      '.auction-name'
    )->getText() != 'Chaussette sale') {
      throw new Exception('auction was not found');
    }

    Universe::getUniverse()->setCanDelete(['user'=>true, 'auctions'=>true]);
  }
}
