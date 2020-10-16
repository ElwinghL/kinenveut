<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc23Context implements Context
{
  /**
   * @Given L'utilisateur est sur la page de connexion admin
   */
  public function lutilisateurEstSurLaPageDeConnexionAdmin()
  {
    $session = Universe::getUniverse()->getSession();
    $user = new UserModel();
    $user->setEmail('emailInvalide@popo.fr')->setPassword('myAmazingPassword');
    Universe::getUniverse()->setUser($user);
    $session->visit('http://localhost/kinenveut/');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }
  }

  /**
   * @When l'utilisateur entre une paire nom\/mdp invalide
   */
  public function lutilisateurEntreUnePaireNomMdpInvalide()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $session->getPage()->find(
      'css',
      'input[name="email"]'
    )->setValue($user->getEmail());
    $session->getPage()->find(
      'css',
      'input[name="password"]'
    )->setValue($user->getPassword());
    $session->getPage()->find(
      'css',
      'input[name="connection"]'
    )->click();
  }

  /**
   * @Then l'accès admin est refusé
   */
  public function laccesAdminEstRefuse()
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
}
