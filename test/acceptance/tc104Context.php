<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

include_once 'src/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc104Context implements Context
{
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
   * @Given l'utilisateur se connecte
   */
  public function lutilisateurSeConnecte()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $session->visit('http://localhost/kinenveut/');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
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
      'input[name="connection"]'
    )->click();

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=home') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=home"');
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
