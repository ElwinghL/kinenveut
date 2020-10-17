<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc104Context implements Context
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
   * @Given l'utilisateur est un administrateur
   */
  public function lutilisateurEstUnAdministrateur()
  {
    $user = new UserModel();
    $user->setEmail('admin@kinenveut.fr');
    $user->setPassword('password');
    Universe::getUniverse()->setUser($user);
  }

  /**
   * @Given L'utilisateur est connecté
   */
  public function lutilisateurEstConnecte()
  {
    /*Try to go to home page. If you are redirect to login page then you're offline*/
    $session = Universe::getUniverse()->getSession();
    $session->visit('http://localhost/kinenveut/');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }

    /*Check if the user is well initialized*/
    $user = Universe::getUniverse()->getUser();
    if ($user == null) {
      throw new Exception('The user has not been correctly intialized');
    } else {
      if ($user->getEmail() == null) {
        throw new Exception('The user has no email');
      }
    }

    /*Check if the user already suscribed*/
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $userFromDB = $userDao->selectUserByEmail($user->getEmail());

    /*If the user doesn't exist, let's create him !*/
    if ($userFromDB == null) {
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

      /*So now, the administrator has to accept him !*/

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

      /*Connection as Admin*/
      $userAdmin = new UserModel();
      $userAdmin->setEmail('admin@kinenveut.fr');
      $userAdmin->setPassword('password');

      //Mail
      $session->getPage()->find(
        'css',
        'input[name="email"]'
      )->setValue($userAdmin->getEmail());
      //Password
      $session->getPage()->find(
        'css',
        'input[name="password"]'
      )->setValue($userAdmin->getPassword());

      /*Click to connect*/
      $session->getPage()->find(
        'css',
        'input[type="submit"]'
      )->click();

      if ($session->getStatusCode() !== 200) {
        throw new Exception('status code is not 200');
      }
      if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=home') {
        throw new Exception('url is not "http://localhost/kinenveut/?r=home"');
      }

      /*Go to the user managment page*/
      $url = 'http://localhost/kinenveut/?r=userManagement';
      $session->visit($url);
      if ($session->getStatusCode() !== 200) {
        throw new Exception('status code is not 200');
      }
      if ($session->getCurrentUrl() !== $url) {
        throw new Exception('url is not ' . $url);
      }

      /*Click to accept the prevent created user*/
      $userFromDB = $userDao->selectUserByEmail($user->getEmail());
      $user->setId($userFromDB->getId());
      $href = '?r=userManagement/validate&id=' . $user->getId();
      $session->getPage()->find(
        'css',
        'a[href="' . $href . '"]'
      )->click();

      $url = 'http://localhost/kinenveut/?r=userManagement/validate&id=' . $user->getId();
      if ($session->getCurrentUrl() !== $url) {
        throw new Exception($session->getCurrentUrl() . 'url is not "' . $url . '"');
      }

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
    }

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

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=home') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=home"');
    }
  }

  /**
   * @Given l'utilisateur consulte les catégories d'enchères
   */
  public function lutilisateurConsulteLesCategoriesDencheres()
  {
    $session = Universe::getUniverse()->getSession();
    $session->visit('http://localhost/kinenveut/?r=categorie');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=categorie') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=categorie"');
    }
  }

  /**
   * @Given la liste de catégories est vide
   */
  public function laListeDeCategoriesEstVide()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur ajoute une catégorie avec le nom :arg1
   */
  public function lutilisateurAjouteUneCategorieAvecLeNom($arg1)
  {
    $session = Universe::getUniverse()->getSession();

    $session->visit('http://localhost/kinenveut/?r=categorie/update_page');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=categorie/update_page') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=categorie/update_page"');
    }
    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue($arg1);
    $session->getPage()->find(
      'css',
      'input[name="createCategory"]'
    )->click();
  }

  /**
   * @Then une nouvelle catégorie nommée :arg1 apparaît
   */
  public function uneNouvelleCategorieNommeeApparait($arg1)
  {
    $session = Universe::getUniverse()->getSession();

    $session->visit('http://localhost/kinenveut/?r=categorie');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=categorie') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=categorie"');
    }
    if ($session->getPage()->find(
      'css',
      '.list-group-item'
    )->getText() != $arg1) {
      throw new Exception('category was not found');
    }
  }

  /**
   * @When l'utilisateur renomme la catégorie avec le nom :arg1 en :arg2
   */
  public function lutilisateurRenommeLaCategorieAvecLeNomEn($arg1, $arg2)
  {
    throw new PendingException();
  }

  /**
   * @Then l'ancienne catégorie :arg1 prend le nom :arg2
   */
  public function lancienneCategoriePrendLeNom($arg1, $arg2)
  {
    throw new PendingException();
  }

  /**
   * @Given la liste de catégories contient :arg1
   */
  public function laListeDeCategoriesContient($arg1)
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur supprime la catégorie :arg1
   */
  public function lutilisateurSupprimeLaCategorie($arg1)
  {
    throw new PendingException();
  }

  /**
   * @Then la catégorie :arg1 disparaît
   */
  public function laCategorieDisparait($arg1)
  {
    throw new PendingException();
  }
}
