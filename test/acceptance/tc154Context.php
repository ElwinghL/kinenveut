<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc154Context implements Context
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
   * @Given il existe un ou plusieurs membres en attente de validation d'inscription
   */
  public function ilExisteUnOuPlusieursMembresEnAttenteDeValidationDinscription()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();

    /*Disconnect*/
    //todo : find a way to click on the disconnect button
    $session->visit('http://localhost/kinenveut/?r=logout');

    //The user is redirect to the login page

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }

    /*Create a new user*/
    $localUser = new UserModel();
    $localUser
          ->setFirstName('Capucine')
          ->setLastName('Dupont')
          ->setBirthDate(DateTime::createFromFormat('d/m/Y', '01/06/1995'))
          ->setEmail('capucine.dupont@kinenveut.fr')
          ->setPassword('password');

    Universe::getUniverse()->setUser2($localUser);

    /*Go to suscribe page*/
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

    /*Fill the form*/
    $session->getPage()->find(
      'css',
      'input[name="firstName"]'
    )->setValue($localUser->getFirstName());
    $session->getPage()->find(
      'css',
      'input[name="lastName"]'
    )->setValue($localUser->getLastName());
    $session->getPage()->find(
      'css',
      'input[name="birthDate"]'
    )->setValue($localUser->getBirthDate()->format('d/m/Y'));
    $session->getPage()->find(
      'css',
      'input[name="email"]'
    )->setValue($localUser->getEmail());
    $session->getPage()->find(
      'css',
      'input[name="password"]'
    )->setValue($localUser->getPassword());

    /*Click on suscribe*/
    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();

    //The user is redirect to the login page

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }

    /*Fill the form*/
    $session->getPage()->find(
      'css',
      'input[name="email"]'
    )->setValue($user->getEmail());
    $session->getPage()->find(
      'css',
      'input[name="password"]'
    )->setValue($user->getPassword());

    /*Click to connect*/
    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();

    //The user is redirect to the home page

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=home') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=home"');
    }
  }

  /**
   * @When l'utilisateur consulte la liste des utilisateurs en attente d'inscription
   */
  public function lutilisateurConsulteLaListeDesUtilisateursEnAttenteDinscription()
  {
    $session = Universe::getUniverse()->getSession();

    /*Go to the page to create an auction*/
    $session->visit('http://localhost/kinenveut/?r=userManagement');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=userManagement') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=userManagement"');
    }
  }

  /**
   * @Then la liste des utilisateurs est visible
   */
  public function laListeDesUtilisateursEstVisible()
  {
    $session = Universe::getUniverse()->getSession();
    if ($session->getPage()->find(
      'css',
      '#waitingList'
    ) == false) {
      throw new Exception('The waiting list was not found');
    }

    if ($session->getPage()->find(
      'css',
      '#waitingList li'
    ) == false) {
      throw new Exception('The waiting list is empty');
    }

    Universe::getUniverse()->setCanDelete(['user2' => true]);
  }
}
