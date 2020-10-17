<?php

use Behat\Behat\Context\Context;

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
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }
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
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=home') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=home"');
    }
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
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login/login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login/login"');
    }
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
