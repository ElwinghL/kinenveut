<?php

use Behat\Behat\Context\Context;

include_once 'tools.php';

/**
 * Defines application features from the specific context.
 */
class tc107Context implements Context
{
  /**
   * @Given l'utilisateur est un administrateur de l'enchère
   */
  public function lutilisateurEstUnAdministrateurDeLenchere()
  {
    $session = Universe::getUniverse()->getSession();
    $admin = Universe::getUniverse()->getUser();
    //Création de l'enchère et validation
    visitCreateAuction($session);

    $auction = new AuctionModel();
    $auction
      ->setName('auction_feature_107')
      ->setId(666)
      ->setPrivacyId(1);

    Universe::getUniverse()->setAuction($auction);

    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue($auction->getName());
    $session->getPage()->find(
      'css',
      '#privacyId'
    )->selectOption($auction->getPrivacyId());
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();

    //Déconnexion
    disconnect($session);

    //Création des users pour la suite
    /*Create a new user*/
    $unUser = new UserModel();
    $unUser
      ->setFirstName('Un')
      ->setLastName('User')
      ->setBirthDate(DateTime::createFromFormat('d/m/Y', '01/06/1995'))
      ->setEmail('un.user@kinenveut.fr')
      ->setPassword('password');

    Universe::getUniverse()->setUser2($unUser);

    /*Go to subscribe page*/
    visitRegistrationPage($session);

    suscribe($session, $unUser);

    //Accepter les users et l'enchère
    connect($session, $admin);

    visitUserManagment($session);
    //TODO : Faire une séléction par ID
    $btnAccept = $session->getPage()->find('css', '.btn-success');
    $btnAccept->click();

    visitAuctionManagement($session);
    $btnAccept = $session->getPage()->find('css', '.btn-success');
    $btnAccept->click();

    //Déconnexion
    disconnect($session);

    //Connexion sur les autres compte
    connect($session, $unUser);
    //TODO : Séléction par ID/nom
    if ($session->getPage()->find(
      'css',
      '.auction-title-custom'
    )->getText() != 'auction_feature_107') {
      throw new Exception('auction was not found');
    }
    $auctionCard = $session->getPage()->find('css', '.card-product');
    $auctionCard->click();
    checkUrlPartial($session, 'kinenveut/?r=bid/index&auctionId=');
    $session->getPage()->find('css', '#btnAuctionRequest')->click();
    if ($session->getPage()->find(
      'css',
      '#btnAuctionCancelRequest'
    )->getText() != 'Annuler ma demande') {
      throw new Exception('Demande non validée');
    }
    disconnect($session);

  }

  /**
   * @Given il accèdes à la page des demandes d'accès à ses enchères
   */
  public function ilAccedesALaPageDesDemandesDaccesASesEncheres()
  {
    $session = Universe::getUniverse()->getSession();
    $admin = Universe::getUniverse()->getUser();
    connect($session, $admin);
    visitRequestPage($session);
  }

  /**
   * @When l'utilisateur clique sur le bouton d'éjection d'une personne ayant demandée à participer à l'enchère
   */
  public function lutilisateurCliqueSurLeBoutonDejectionDunePersonneAyantDemandeeAParticiperALenchere()
  {
    $session = Universe::getUniverse()->getSession();
    $url = 'kinenveut/?r=accessRequest';
    checkUrlPartial($session, $url);
    //TODO : Faire une séléction par ID
    $btnRefuse = $session->getPage()->find('css', '.btn-danger');
    $btnRefuse->click();
    disconnect($session);
  }

  /**
   * @Then cette personne est refusée
   */
  public function cettePersonneEstRefusee()
  {
    $session = Universe::getUniverse()->getSession();
    $unUser = Universe::getUniverse()->getUser2();
    connect($session, $unUser);
    //TODO : Séléction par ID/nom
    if ($session->getPage()->find(
      'css',
      '.auction-title-custom'
    )->getText() != 'auction_feature_107') {
      throw new Exception('auction was not found');
    }
    $auctionCard = $session->getPage()->find('css', '.card-product');
    $auctionCard->click();
    checkUrlPartial($session, 'kinenveut/?r=bid/index&auctionId=');
    if ($session->getPage()->findById('forbidedAuctionAccess')->getText() != 'Vous n\'êtes pas autorisé à participer à cette enchère') {
      throw new Exception("L'utilisateur n'est pas refusé");
    }
  }

  /**
   * @Then ne peut pas participer à cette enchère privée
   */
  public function nePeutPasParticiperACetteEncherePrivee()
  {
    $session = Universe::getUniverse()->getSession();
    if ($session->getPage()->findById('makeabid') != null) {
      throw new Exception("L'utilisateur peut participer");
    }
    disconnect($session);
  }

  /**
   * @When l'utilisateur clique sur le bouton d'acceptation d'une personne ayant demandée à participer à l'enchère
   */
  public function lutilisateurCliqueSurLeBoutonDacceptationDunePersonneAyantDemandeeAParticiperALenchere()
  {
    $session = Universe::getUniverse()->getSession();
    $url = 'kinenveut/?r=accessRequest';
    checkUrlPartial($session, $url);
    //TODO : Faire une séléction par ID
    $btnRefuse = $session->getPage()->find('css', '.btn-success');
    $btnRefuse->click();
    disconnect($session);
  }

  /**
   * @Then cette personne est acceptée
   */
  public function cettePersonneEstAcceptee()
  {
    $session = Universe::getUniverse()->getSession();
    $unUser = Universe::getUniverse()->getUser2();
    connect($session, $unUser);
    //TODO : Séléction par ID/nom
    if ($session->getPage()->find(
      'css',
      '.auction-title-custom'
    )->getText() != 'auction_feature_107') {
      throw new Exception('auction was not found');
    }
    $auctionCard = $session->getPage()->find('css', '.card-product');
    $auctionCard->click();
    checkUrlPartial($session, 'kinenveut/?r=bid/index&auctionId=');
    if ($session->getPage()->findById('forbidedAuctionAccess') != null) {
      throw new Exception("L'utilisateur n'est pas accepté");
    }
  }

  /**
   * @Then peut alors participer à cette enchère privée
   */
  public function peutAlorsParticiperACetteEncherePrivee()
  {
    $session = Universe::getUniverse()->getSession();
    if ($session->getPage()->findById('makeabid') == null) {
      throw new Exception("L'utilisateur ne peut pas participer");
    }
  }
}
