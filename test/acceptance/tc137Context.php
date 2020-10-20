<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc137Context implements Context
{
  /**
   * @Given l'utilisateur participe à des enchères.
   */
  public function lutilisateurParticipeADesEncheres()
  {
    $session = Universe::getUniverse()->getSession();
    $currentUser = Universe::getUniverse()->getUser();
    $user2 = new UserModel();
    $userAdmin = new UserModel();
    $auction = new AuctionModel();

    $userAdmin
          ->setEmail('admin@kinenveut.fr')
          ->setPassword('password');

    Universe::getUniverse()->setUser3($userAdmin);

    disconnect($session);

    /*Create a new user*/
    $user2 = new UserModel();
    $user2
          ->setFirstName('Capucine')
          ->setLastName('Dupont')
          ->setBirthDate(DateTime::createFromFormat('d/m/Y', '01/06/1995'))
          ->setEmail('capucine.dupont@kinenveut.fr')
          ->setPassword('password');

    Universe::getUniverse()->setUser2($user2);

    visitRegistrationPage($session);
    suscribe($session, $user2);
    if ($user2->getId() == null || $user2->getId() < 1) {
      $userDao = App_DaoFactory::getFactory()->getUserDao();
      $userFromDB = $userDao->selectUserByEmail($user2->getEmail());
      Universe::getUniverse()->getUser2()->setId($userFromDB->getId());
      $user2 = Universe::getUniverse()->getUser2();
    }

    /*Connection as Admin*/
    connect($session, $userAdmin);
    visitUserManagment($session);

    //Todo : search by name
    /*Click to accept the prevent created user*/
    $href = '?r=userManagement/validate&id=' . $user2->getId();
    $session->getPage()->find(
      'css',
      'a[href="' . $href . '"]'
    )->click();

    $url = 'kinenveut/?r=userManagement/validate&id=' . $user2->getId();
    checkUrl($url);

    disconnect($session);
    connect($session, $user2);

    /*Create a new auction*/

    visitCreateAuction($session);

    $auction
          ->setName('Objet test123')
          ->setDescription('Ceci est une enchère insérée lors de tests.')
          ->setBasePrice(3)
          ->setReservePrice(7)
          ->setDuration(7)
          ->setSellerId($user2->getId())
          ->setPrivacyId(0)
          ->setCategoryId(1)
          ->setStartDate(new DateTime());

    Universe::getUniverse()->setAuction($auction);

    createAuction($session, $auction);

    disconnect($session);

    /*Connection as Admin*/
    connect($session, $userAdmin);

    visitAuctionManagement($session);

    //Todo : use the name to find the button :)
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $userAuctions = $auctionDao->selectAllAuctionsBySellerId($user2->getId());

    if (count($userAuctions) == 1) {
      $auction->setId($userAuctions[0]->getId());
    } else {
      throw new Exception('A problem happenned while create an auction');
    }

    /*Click to accept the prevent created auction*/
    $url = 'kinenveut/?r=auctionManagement/validate&id=' . $auction->getId();
    $session->visit($_ENV['path'].$url);
    checkUrl($url);

    disconnect($session);

    /*Now connect the user who will participate to the auction*/
    connect($session, $currentUser);

    if ($session->getPage()->find(
      'css',
      '.auction-title-custom'
    )->getText() != $auction->getName()) {
      throw new Exception('The created auction was not found');
    }

    /*Make a bid !*/

    $url = 'kinenveut/?r=bid/index&auctionId=' . $auction->getId();
    $session->visit($_ENV['path'].$url);
    checkUrl($url);

    $session->getPage()->find(
      'css',
      'input[name="bidPrice"]'
    )->setValue(1000);

    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();
  }

  /**
   * @When L'utilisateur consulte les enchères auxquelles il participe.
   */
  public function lutilisateurConsulteLesEncheresAuxquellesIlParticipe()
  {
    $session = Universe::getUniverse()->getSession();
    visitBids($session);
  }

  /**
   * @Then L'utilisateur voit les enchères auxquelles il participe.
   */
  public function lutilisateurVoitLesEncheresAuxquellesIlParticipe()
  {
    $session = Universe::getUniverse()->getSession();
    if ($session->getPage()->find(
      'css',
      '#auctionList'
    ) == false) {
      throw new Exception('The auction list was not found');
    }

    if ($session->getPage()->find(
      'css',
      '#auctionList li'
    ) == false) {
      throw new Exception('The auction list is empty');
    }
  }
}
