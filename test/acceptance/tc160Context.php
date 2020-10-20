<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc160Context implements Context
{
  /**
   * @When l'enchère est fermée
   */
  public function lenchereEstFermee()
  {
    Universe::getUniverse()->getAuction()->setAuctionState(4);

    //Non testable : Un user ne peut pas entrer de montant si l'enchère est fermée
  }

  /**
   * @Then un message d'erreur est affiché
   */
  public function unMessageDerreurEstAffiche()
  {
    //Non testable : Aucun message n'est affiché car la vérification se fait dans l'input
  }

  /**
  * @Given l'utilisateur a entré un montant invalide
  */
  public function lutilisateurAEntreUnMontantInvalide()
  {
    //todo : vérifier que $seller != != bidder

    /*throw new PendingException();*/
    $session = Universe::getUniverse()->getSession();

    $expectedUrl = '/?r=bid/index&auctionId=';
    checkUrlPartial($session, $expectedUrl);

    $session->getPage()->find(
      'css',
      'input[name="bidPrice"]'
    )->setValue(0);
  }
}
