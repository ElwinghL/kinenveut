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

  public function __destruct()
  {
    $canDelete = Universe::getUniverse()->getCanDelete();
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    if (isset($canDelete['user'])) {
      $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());
      $isAdmin = $user->getIsAdmin();
      if ($isAdmin == false) {
        $userDao->deleteUser($user->getId());
      }
      unset($canDelete['user']);
      Universe::getUniverse()->setCanDelete($canDelete);
    }
    if (isset($canDelete['user2'])) {
      $user2 = $userDao->selectUserByEmail(Universe::getUniverse()->getUser2()->getEmail());
      $isAdmin2 = $user2->getIsAdmin();
      if ($isAdmin2 == false) {
        $userDao->deleteUser($user2->getId());
      }
      unset($canDelete['user2']);
      Universe::getUniverse()->setCanDelete($canDelete);
    }
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
    )->setValue($user->getLastName());
    $session->getPage()->find(
      'css',
      'input[name="birthDate"]'
    )->setValue($user->getBirthDate()->format('d/m/Y'));
    $session->getPage()->find(
      'css',
      'input[name="email"]'
    )->setValue($user->getEmail());
    $session->getPage()->find(
      'css',
      'input[name="password"]'
    )->setValue($user->getPassword());

    Universe::getUniverse()->setCanDelete(['user'=>true]);
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
      throw new Exception($session->getCurrentUrl() . ' url is not "http://localhost/kinenveut/?r=login"');
    }
  }
}
