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

    Universe::getUniverse()->getAuction()->setBestBid(new BidModel());
    Universe::getUniverse()->getAuction()->getBestBid()->setBidPrice(Universe::getUniverse()->getAuction()->getBasePrice());

    /*Now connect the user who will participate to the auction*/
    connect($session, $currentUser);

    $url = 'kinenveut/?r=bid/index&auctionId=' . $auction->getId();
    $session->visit($_ENV['path'].$url);
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

    if ($session->getPage()->find(
      'css',
      'input[name="bidPrice"]'
    ) == false) {
      throw new Exception('The user is not authorized to bid !');
    };
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
    )->getText() != Universe::getUniverse()->getAuction()->getName() . ' - ' . Universe::getUniverse()->getAuction()->getBestBid()->getBidPrice() . '€') {
      throw new Exception('bid is not valid');
    };
  }

  /**
   * @Given l'utilisateur a entré un montant valide
   */
  public function lutilisateurAEntreUnMontantValide()
  {
    $session = Universe::getUniverse()->getSession();
    $bidPrice = (Universe::getUniverse()->getAuction()->getBasePrice() + 1) * 2;
    $auction = Universe::getUniverse()->getAuction();

    $session->getPage()->find(
      'css',
      'input[name="bidPrice"]'
    )->setValue($bidPrice);

    //todo : check that there is not any errors :)

    Universe::getUniverse()->getAuction()->getBestBid()->setBidPrice($bidPrice);
  }

  /**
   * @When l'utilisateur clique sur le bouton pour enchérir
   */
  public function lutilisateurCliqueSurLeBoutonPourEncherir()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      '#makeabid'
    ) == null) {
      throw new Exception('user cannot bid');
    }
    $session->getPage()->find(
      'css',
      '#makeabid'
    )->click();
  }

  /**
   * @Then l'enchère de l'utilisateur est acceptée
   */
  public function lenchereDeLutilisateurEstAcceptee()
  {
    $session = Universe::getUniverse()->getSession();
    $auction = Universe::getUniverse()->getAuction();
    $bidPrice = $auction->getBestBid()->getBidPrice();

    if ($session->getPage()->find(
      'css',
      'h2'
    )->getText() != $auction->getName() . ' - ' . $bidPrice . '€') {
      throw new Exception('The auction title is not the expected one so the previous bid must not be valid');
    };

  }
}
