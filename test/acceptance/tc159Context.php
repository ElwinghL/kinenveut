<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc159Context implements Context
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
    $auction = new AuctionModel();
    $auction->setName('Banana')->setBasePrice(0)->setReservePrice(0)->setDuration(7)->setSellerId(1)->setPrivacyId(0)->setCategoryId(1);
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionId = $auctionDao->insertAuction($auction);
    $auction->setId($auctionId)->setAuctionState(1);
    $auctionDao->updateAuctionState($auction);
    Universe::getUniverse()->setAuctionId($auctionId);
  }

  public function __destruct()
  {
    deleteAuctionUniverse();
    deleteUserUniverse();
  }

  /**
   * @Given l'utilisateur est sur la page d'une enchère
   */
  public function lutilisateurEstSurLaPageDuneEnchere()
  {
      $session = Universe::getUniverse()->getSession();
      $currentUser = Universe::getUniverse()->getUser();
      $user2 = new UserModel();
      $userAdmin = new UserModel();
      $auction = new AuctionModel();

      $session = Universe::getUniverse()->getSession();
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

      $url = 'http://localhost/kinenveut/?r=userManagement/validate&id=' . $user2->getId();
      checkUrl($session, $url);

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
      $url = 'http://localhost/kinenveut/?r=auctionManagement/validate&id=' . $auction->getId();
      $session->visit($url);
      checkUrl($session, $url);

      disconnect($session);

      /*Now connect the user who will participate to the auction*/
      connect($session, $currentUser);

    $url = 'http://localhost/kinenveut/?r=bid/index&auctionId=' . $auction->getId();
    $session->visit($url);
    checkUrl($session, $url);
  }

  /**
   * @Given l'utilisateur peut participer à l'enchère
   */
  public function lutilisateurPeutParticiperALenchere()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      '#bid-button'
    ) == null) {
      throw new Exception('user cannot bid');
    }
  }

  /**
   * @Given l'utilisateur a entré au préalable le montant de l'enchère
   */
  public function lutilisateurAEntreAuPrealableLeMontantDeLenchere()
  {
    $session = Universe::getUniverse()->getSession();

    $session->getPage()->find(
      'css',
      'input[name="bidPrice"]'
    )->setValue(42);
  }

  /**
   * @When l'utilisateur clique sur le bouton d'enchère
   */
  public function lutilisateurCliqueSurLeBoutonDenchere()
  {
    $session = Universe::getUniverse()->getSession();

    $session->getPage()->find(
      'css',
      '#bid-button'
    )->click();
  }

  /**
   * @When l'enchère est ouverte
   */
  public function lenchereEstOuverte()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      'h2'
<<<<<<< HEAD
    )->getText() != 'Banana - 42€') {
=======
    )->getText() != 'Objet test123 - 42€') {
>>>>>>> origin/dev
      throw new Exception('bid is not valid');
    };
  }

  /**
   * @When l'utilisateur a choisi un montant valide
   */
  public function lutilisateurAChoisiUnMontantValide()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      'h2'
<<<<<<< HEAD
    )->getText() != 'Banana - 42€') {
=======
    )->getText() != 'Objet test123 - 42€') {
>>>>>>> origin/dev
      throw new Exception('bid is not valid');
    };
  }

  /**
   * @Then l'utilisateur enchérit du montant choisi
   */
  public function lutilisateurEncheritDuMontantChoisi()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      'h2'
<<<<<<< HEAD
    )->getText() != 'Banana - 42€') {
=======
    )->getText() != 'Objet test123 - 42€') {
>>>>>>> origin/dev
      throw new Exception('bid is not valid');
    };

    $sellers = [Universe::getUniverse()->getUser()];
    Universe::getUniverse()->setCanDelete(['user'=>true,'user2'=>true, 'auctions'=>$sellers]);
  }
}
