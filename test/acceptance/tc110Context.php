<?php

use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc110Context implements Context
{
  /**
   * @Given L'utilisateur est sur la page de recherche
   */
  public function lutilisateurEstSurLaPageDeRecherche()
  {
    $session = Universe::getUniverse()->getSession();
    $url = 'kinenveut/?r=home';
    $session->visit($url);
    checkUrl($url);
  }

  /**
   * @When l'utilisateur recherche une vente publique existant dans la base de donnée
   */
  public function lutilisateurRechercheUneVentePubliqueExistantDansLaBaseDeDonnee()
  {
    /*Let's add an auction to the current user, as seen in tc71*/
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $auction = new AuctionModel();

    if ($user->getId() == null || $user->getId() < 1) {
      $userDao = App_DaoFactory::getFactory()->getUserDao();
      $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());
      Universe::getUniverse()->getUser()->setId($user->getId());
      $user = Universe::getUniverse()->getUser();
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

    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $userAuctions = $auctionDao->selectAllAuctionsBySellerId($user->getId());

    if (count($userAuctions) == 1) {
      $auction->setId($userAuctions[0]->getId());
    } else {
      throw new Exception('A problem happenned while create an auction');
    }

    /*Click to accept the prevent created auction*/
    $url = 'kinenveut/?r=auctionManagement/validate&id=' . $auction->getId();
    $session->visit($url);
    checkUrl($url);

    disconnect($session);

    connect($session, $user);

    /*Ok, great ! Now the user can search is own auction*/

    $session->getPage()->find(
      'css',
      'input[name="searchInput"]'
    )->setValue($auction->getName());
    $session->getPage()->find(
      'css',
      '#privacyId'
    )->selectOption(0);
  }

  /**
   * @When L'utilisateur clique sur le bouton rechercher
   */
  public function lutilisateurCliqueSurLeBoutonRechercher()
  {
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();
  }

  /**
   * @Then il trouve cette enchère
   */
  public function ilTrouveCetteEnchere()
  {
    $session = Universe::getUniverse()->getSession();
    $auction = Universe::getUniverse()->getAuction();

    if ($session->getPage()->find(
      'css',
      '.auction-title-custom'
    )->getText() != $auction->getName()) {
      throw new Exception('auction was not found');
    }

    Universe::getUniverse()->setToDelete(['users' => [Universe::getUniverse()->getUser()]]);
  }
}
