<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc30Context implements Context
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
   * @Given L'utilisateur est sur la page de création de compte.
   */
  public function lutilisateurEstSurLaPageDeCreationDeCompte()
  {
    $session = Universe::getUniverse()->getSession();
    $session->visit('http://localhost/kinenveut/');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }

    $session->getPage()->find(
      'css',
      'a[href="?r=registration"]'
    )->click();

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=registration') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=registration"');
    }
  }

  /**
   * @When L'utilisateur renseigne les champs de saisies.
   */
  public function lutilisateurRenseigneLesChampsDeSaisies()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $session->getPage()->find(
      'css',
      'input[name="firstName"]'
    )->setValue($user->getFirstName());
    $session->getPage()->find(
      'css',
      'input[name="lastName"]'
    )->setValue($user->getPassword());
    $session->getPage()->find(
      'css',
      'input[name="birthDate"]'
    )->setValue($user->getPassword());
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
      'input[type="submit"]'
    )->click();
  }

  /**
   * @Then Le compte de l'utilisateur est enregistré.
   */
  public function leCompteDeLutilisateurEstEnregistre()
  {
    $session = Universe::getUniverse()->getSession();
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }
  }
}
