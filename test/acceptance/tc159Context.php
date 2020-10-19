<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc159Context implements Context
{
  /**
   * @Given l'utilisateur est sur la page d'une enchère
   */
  public function lutilisateurEstSurLaPageDuneEnchere()
  {
    $session = Universe::getUniverse()->getSession();
    $currentUser = Universe::getUniverse()->getUser();

    /*Create a new user*/
    $user2 = new UserModel();
    $user2
          ->setFirstName('Capucine')
          ->setLastName('Dupont')
          ->setBirthDate(DateTime::createFromFormat('d/m/Y', '01/06/1995'))
          ->setEmail('capucine.dupont@kinenveut.fr')
          ->setPassword('password');
    Universe::getUniverse()->setUser2($user2);

    /*Create a new auction*/
    $auction = new AuctionModel();
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

    disconnect($session);

    $userId = subscribeAndValidateAUser($user2);
    if ($userId != null && $userId > 0) {
      Universe::getUniverse()->getUser2()->setId($userId);
    }

    connect($session, $user2);
    visitCreateAuction($session);
    $auctionId = createAuctionForUser($auction, $user2);
    if ($auctionId != null && $auctionId > 0) {
      Universe::getUniverse()->getAuction()->setId($auctionId);
    }

    /*Now connect the user who will participate to the auction*/
    connect($session, $currentUser);

    $url = 'http://localhost/kinenveut/?r=bid/index&auctionId=' . $auction->getId();
    $session->visit($url);
    checkUrl($url);
  }

  /**
   * @Given l'utilisateur peut participer à l'enchère
   */
  public function lutilisateurPeutParticiperALenchere()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      'h3'
    ) != null) {
      if ($session->getPage()->find(
        'css',
        '#makeabid'
      ) == null) {
        throw new Exception('user cannot bid');
      }
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
      '#makeabid'
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
    )->getText() != Universe::getUniverse()->getAuction()->getName() . ' - 42€') {
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
    )->getText() != 'Objet test123 - 42€') {
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
    )->getText() != 'Objet test123 - 42€') {
      throw new Exception('bid is not valid');
    };

    Universe::getUniverse()->setToDelete(['users' => [Universe::getUniverse()->getUser(), Universe::getUniverse()->getUser2()]]);
  }
}
