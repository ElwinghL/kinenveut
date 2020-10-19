<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc340Context implements Context
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
    $auction->setName('Banana')->setBasePrice(42)->setReservePrice(200)->setDuration(7)->setSellerId(1)->setPrivacyId(0)->setCategoryId(1);
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionId = $auctionBo->insertAuction($auction);
    $auction->setId($auctionId)->setAuctionState(1);
    $auctionBo->updateAuctionState($auction);
    Universe::getUniverse()->setAuction($auction);
  }

  public function __destruct()
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionBo->deleteAuctionById(Universe::getUniverse()->getAuction()->getId());
  }

  /**
   * @When l'utilisateur arrive sur la page d'une enchère
   */
  public function lutilisateurArriveSurLaPageDuneEnchere()
  {
    $session = Universe::getUniverse()->getSession();

    $url = 'http://localhost/kinenveut/?r=bid/index&auctionId=' . Universe::getUniverse()->getAuction()->getId();
    $session->visit($url);

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== $url) {
      throw new Exception('url is not ' . $url);
    }
  }

  /**
   * @Then l'utilisateur visualise les données de la dernière enchère effectuée
   */
  public function lutilisateurVisualiseLesDonneesDeLaDerniereEnchereEffectuee()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      'h2'
    )->getText() != Universe::getUniverse()->getAuction()->getName() . ' - 42€') {
      throw new Exception('bid is not valid');
    };
  }
}
