<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc104Context implements Context
{
  //Todo : trouver un moyen de récupérer l'id d'un élément d'une liste en connaissant seulement le titre (contenu de la div)

  /**
   * @Given l'utilisateur est un administrateur
   */
  public function lutilisateurEstUnAdministrateur()
  {
    $userAdmin = new UserModel();
    $userAdmin
        ->setEmail('admin@kinenveut.fr')
        ->setPassword('password');
    Universe::getUniverse()->setUser($userAdmin);
  }

  /**
   * @Given L'utilisateur est connecté
   */
  public function lutilisateurEstConnecte()
  {
    /*Try to go to home page. If you are redirect to login page then you're offline*/
    $session = Universe::getUniverse()->getSession();

    $session->visit($_ENV['path'] . 'kinenveut/');
    checkUrl('kinenveut/?r=login');

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
      $userId = subscribeAndValidateAUser($user);
    } else {
      $userId = $userFromDB->getId();
    }

    Universe::getUniverse()->getUser()->setId($userId);

    connect($session, $user);
  }

  /**
   * @Given l'utilisateur consulte les catégories d'enchères
   */
  public function lutilisateurConsulteLesCategoriesDencheres()
  {
    $session = Universe::getUniverse()->getSession();
    visitCategoriesManagment($session);
  }

  /**
   * @Given la liste de catégories est vide
   */
  public function laListeDeCategoriesEstVide()
  {
    //Non testable car on ne peut pas vider la liste pour les tests :)
    // throw new PendingException();
  }

  /**
   * @When l'utilisateur ajoute une catégorie avec le nom :arg1
   */
  public function lutilisateurAjouteUneCategorieAvecLeNom($arg1)
  {
    throw new PendingException();
    $session = Universe::getUniverse()->getSession();

    $url = 'kinenveut/?r=categorie/update_page';
    $session->visit($_ENV['path'] . $url);
    checkUrl($url);

    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue($arg1);
    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();
  }

  /**
   * @Then une nouvelle catégorie nommée :arg1 apparaît
   */
  public function uneNouvelleCategorieNommeeApparait($arg1)
  {
    $session = Universe::getUniverse()->getSession();

    $url = 'kinenveut/?r=categorie';
    $session->visit($_ENV['path'] . $url);
    checkUrl($url);

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
    $session = Universe::getUniverse()->getSession();

    $url = 'kinenveut/?r=categorie';
    $session->visit($_ENV['path'] . $url);
    checkUrl($url);

    if ($session->getPage()->find(
      'css',
      '.list-group-item'
    )->getText() != $arg1) {
      throw new Exception('category was not found');
    }
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
