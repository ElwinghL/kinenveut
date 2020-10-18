<?php

use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc108Context implements Context
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

  /**
   * @Given L'utilisateur est sur la page de connexion
   */
  public function lutilisateurEstSurLaPageDeConnexion()
  {
    $session = Universe::getUniverse()->getSession();

    $session->visit('http://localhost/kinenveut/');
    $url = 'http://localhost/kinenveut/?r=login';
    checkUrl($session, $url);
  }

  /**
   * @Given L'utilisateur entre son adresse mail
   */
  public function lutilisateurEntreSonAdresseMail()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $session->getPage()->find(
      'css',
      'input[name="email"]'
    )->setValue($user->getEmail());
  }

  /**
   * @Given L'utilisateur entre son mot de passe
   */
  public function lutilisateurEntreSonMotDePasse()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $session->getPage()->find(
      'css',
      'input[name="password"]'
    )->setValue($user->getPassword());
  }

  /**
   * @When L'utilisateur valide le formulaire
   */
  public function lutilisateurValideLeFormulaire()
  {
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();
  }

  /**
   * @Then L'utilisateur est identifié sur le site
   */
  public function lutilisateurEstIdentifieSurLeSite()
  {
    $session = Universe::getUniverse()->getSession();

    $url = 'http://localhost/kinenveut/?r=home';
    checkUrl($session, $url);
  }

  /**
   * @Given L'utilisateur se trompe d'adresse mail
   */
  public function lutilisateurSeTrompeDadresseMail()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $session->getPage()->find(
      'css',
      'input[name="email"]'
    )->setValue($user->getEmail() . 'z');
  }

  /**
   * @Then L'utilisateur reçoit un message d'erreur approprié
   */
  public function lutilisateurRecoitUnMessageDerreurApproprie()
  {
    $session = Universe::getUniverse()->getSession();

    $url = 'http://localhost/kinenveut/?r=login/login';
    checkUrl($session, $url);

    if ($session->getPage()->find(
      'css',
      '.invalid-feedback.d-block'
    )->getText() != 'Identifiants incorrects') {
      throw new Exception('There is not an error');
    }
  }

  /**
   * @Given L'utilisateur se trompe de mot de passe
   */
  public function lutilisateurSeTrompeDeMotDePasse()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $session->getPage()->find(
      'css',
      'input[name="password"]'
    )->setValue($user->getPassword() . 'z');
  }
}
