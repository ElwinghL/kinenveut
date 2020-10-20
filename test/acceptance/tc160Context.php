<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc160Context implements Context
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

  public function __destruct()
  {
    deleteAuctionUniverse();
    deleteUserUniverse();
  }

  /**
   * @When l'utilisateur clique sur le bouton d'envoi de l'enchère
   */
  public function lutilisateurCliqueSurLeBoutonDenvoiDeLenchere()
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
   * @When l'enchère est fermée
   */
  public function lenchereEstFermee()
  {
    Universe::getUniverse()->getAuction()->setAuctionState(4);

    //Non testable : Un user ne peut pas entrer de montant si l'enchère est fermée
    $sellers = [Universe::getUniverse()->getUser()];
    Universe::getUniverse()->setCanDelete(['user'=>true, 'user2'=>true, 'auctions'=>$sellers]);
  }

  /**
   * @Then un message d'erreur est affiché
   */
  public function unMessageDerreurEstAffiche()
  {
    //Non testable : Aucun message n'est affiché car la vérification se fait dans l'input
    $sellers = [Universe::getUniverse()->getUser()];
    Universe::getUniverse()->setCanDelete(['user'=>true, 'user2'=>true, 'auctions'=>$sellers]);

    //todo : ce test ne répond pas au titre car il n'existe pas d'affichage d'erreur

    throw new PendingException();
    /*
    $session = Universe::getUniverse()->getSession();
    $auction = Universe::getUniverse()->getAuction();
    $minPrice = ($auction->getBasePrice());
    if ($session->getPage()->find(
            'css',
            'h2'
        )->getText() != $auction->getName() . ' - '.$minPrice.'€') {
        throw new Exception('The bid was accepted or is not the first one on this auction');
    };*/
  }

  /**
   * @When l'utilisateur a choisi un montant invalide
   */
  public function lutilisateurAChoisiUnMontantInvalide()
  {
    //todo : vérifier que $seller != != bidder

    $sellers = [Universe::getUniverse()->getUser()];
    Universe::getUniverse()->setCanDelete(['user'=>true, 'user2'=>true, 'auctions'=>$sellers]);

    throw new PendingException();
    $session = Universe::getUniverse()->getSession();

    $expectedUrl = 'http://localhost/kinenveut/?r=bid&auctionId=';
    checkUrlPartial($session, $expectedUrl);

    if ($session->getPage()->find(
      'css',
      'input[name="bidPrice"]'
    )) {
      throw new Exception('The user is not authorized to bid !');
    };
    $session->getPage()->find(
      'css',
      'input[name="bidPrice"]'
    )->setValue(0);
  }
}
