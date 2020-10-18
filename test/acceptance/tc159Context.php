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
   * @Given l'utilisateur est sur la page d'une enchère
   */
  public function lutilisateurEstSurLaPageDuneEnchere()
  {
    $session = Universe::getUniverse()->getSession();

    $url = 'http://localhost/kinenveut/?r=bid/index&auctionId=' . Universe::getUniverse()->getAuctionId();
    $session->visit($url);

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== $url) {
      throw new Exception('url is not ' . $url);
    }
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

    Universe::getUniverse()->setCanDelete(['user'=>true, 'auctions'=>true]);
  }
}
