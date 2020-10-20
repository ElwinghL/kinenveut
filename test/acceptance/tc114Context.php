<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc114Context implements Context
{
  /**
   * @When l'utilisateur recherche une vente privée existant dans la base de données
   */
  public function lutilisateurRechercheUneVentePriveeExistantDansLaBaseDeDonnees()
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
          ->setPrivacyId(1)
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
    $url = 'http://localhost/kinenveut/?r=auctionManagement/validate&id=' . $auction->getId();
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
    )->selectOption(1);
  }
}
