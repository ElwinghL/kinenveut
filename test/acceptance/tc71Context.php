<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc71Context implements Context
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

  /**
   * @When l'utilisateur tape le nom de son objet dans la barre de recherche
   */
  public function lutilisateurTapeLeNomDeSonObjetDansLaBarreDeRecherche()
  {
    $session = Universe::getUniverse()->getSession();
    $auction = Universe::getUniverse()->getAuction();

    $session->getPage()->find(
      'css',
      'input[name="searchInput"]'
    )->setValue($auction->getName());
  }

  /**
   * @Given L'utilisateur possède au moins une enchère
   */
  public function lutilisateurPossedeAuMoinsUneEnchere()
  {
      $session = Universe::getUniverse()->getSession();
      $user = Universe::getUniverse()->getUser();
      $auction = new AuctionModel();

      if($user->getId() == null or $user->getId() < 1)
      {
          $userDao = App_DaoFactory::getFactory()->getUserDao();
          $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());
          Universe::getUniverse()->getUser()->setId($user->getId());
      }

      $auction
          ->setName('Objet test')
          ->setDescription('Ceci est une enchère insérée lors de tests.')
          ->setBasePrice(3)
          ->setReservePrice(7)
          ->setDuration(7)
          ->setSellerId($user->getId())
          ->setPrivacyId(0)
          ->setCategoryId(1)
          ->setStartDate(new DateTime());

      Universe::getUniverse()->setAuction($auction);

      visitCreateAuction($session);

      createAuction($session, $auction);

      disconnect($session);

      /*Connection as Admin*/
      $userAdmin = new UserModel();
      $userAdmin
          ->setEmail('admin@kinenveut.fr')
          ->setPassword('password');

      Universe::getUniverse()->setUser2($userAdmin);

      connect($session, $userAdmin);

      visitAuctionManagement($session);

      /*
      $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
      $userAuctions = $auctionDao->selectAllAuctionsBySellerId($user->getId());
      if(count($userAuctions) == 1)
      {
         $auction->setId($userAuctions[0]->getId());
      }
      else
      {
          throw new Exception('A problem happenned while create an auction');
      }*/

      /*Click to accept the prevent created auction
      $url = 'http://localhost/kinenveut/?r=auctionManagement/validate&id=' . $auction->getId();
      $session->visit($url);
      checkUrl($session, $url);*/

      disconnect($session);

      connect($session, $user);
  }
}
