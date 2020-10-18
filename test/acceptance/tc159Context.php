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
    $auction
        ->setName('Banana')
        ->setBasePrice(0)
        ->setReservePrice(0)
        ->setDuration(7)
        ->setSellerId(1)
        ->setPrivacyId(0)
        ->setCategoryId(1);

    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionId = $auctionDao->insertAuction($auction);
    $auction
        ->setId($auctionId)
        ->setAuctionState(1);
    $auctionDao->updateAuctionState($auction);

    Universe::getUniverse()->setAuction($auction);
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

    $auction = new AuctionModel();
    $auction
      ->setName('Banana')
      ->setBasePrice(0)
      ->setReservePrice(0)
      ->setDuration(7)
      ->setSellerId(1)
      ->setPrivacyId(0)
      ->setCategoryId(1);

    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionId = $auctionDao->insertAuction($auction);
    $auction
      ->setId($auctionId)
      ->setAuctionState(1);
    $auctionDao->updateAuctionState($auction);

    Universe::getUniverse()->setAuction($auction);

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
    )->getText() != 'Banana - 42€') {
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
    )->getText() != 'Banana - 42€') {
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
    )->getText() != 'Banana - 42€') {
      throw new Exception('bid is not valid');
    };

    $sellers = [Universe::getUniverse()->getUser()];
    Universe::getUniverse()->setCanDelete(['user'=>true, 'auctions'=>$sellers]);
  }
}
