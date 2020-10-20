<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc108Context implements Context
{
  /**
   * @Given L'utilisateur est sur la page de connexion
   */
  public function lutilisateurEstSurLaPageDeConnexion()
  {
    $session = Universe::getUniverse()->getSession();

    $session->visit('kinenveut/');
    checkUrl('kinenveut/?r=login');
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

    $url = 'kinenveut/?r=home';
    checkUrl($url);
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

    $url = 'kinenveut/?r=login/login';
    checkUrl($url);

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

  /**
     * @Given L'utilisateur possède un compte sur le site
     */
  public function lutilisateurPossedeUnCompteSurLeSite()
  {
    throw new PendingException();
  }
}
