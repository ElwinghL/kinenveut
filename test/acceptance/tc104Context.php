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
   * @Given L'utilisateur est un admin
   */
  public function lutilisateurEstUnAdmin()
  {
    $user = new UserModel();
    $user->setEmail('admin@kinenveut.fr');
    $user->setPassword('password');
    Universe::getUniverse()->setUser($user);
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
   * @When l'utilisateur ajoute une catégorie avec le nom cuisine
   */
  public function lutilisateurAjouteUneCategorieAvecLeNomCuisine()
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
    )->setValue("Cuisine");
    $session->getPage()->find(
      'css',
      'input[name="createCategory"]'
    )->click();
  }

  /**
   * @Then une nouvelle catégorie nommée cuisine apparaît
   */
  public function uneNouvelleCategorieNommeeCuisineApparait()
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
    )->getText() != "Cuisine") {
      throw new Exception('category was not found');
    }
  }

  /**
   * @When l'utilisateur ajoute une catégorie avec le nom radio
   */
  public function lutilisateurAjouteUneCategorieAvecLeNomRadio()
  {
    throw new PendingException();
  }

  /**
   * @Then une nouvelle catégorie nommée radio apparaît
   */
  public function uneNouvelleCategorieNommeeRadioApparait()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur ajoute une catégorie avec le nom auto
   */
  public function lutilisateurAjouteUneCategorieAvecLeNomAuto()
  {
    throw new PendingException();
  }

  /**
   * @Then une nouvelle catégorie nommée auto apparaît
   */
  public function uneNouvelleCategorieNommeeAutoApparait()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur renomme la catégorie avec le nom cuisinel en cuisine
   */
  public function lutilisateurRenommeLaCategorieAvecLeNomCuisinelEnCuisine()
  {
    throw new PendingException();
  }

  /**
   * @Then l'ancienne catégorie cuisinel prend le nom cuisine
   */
  public function lancienneCategorieCuisinelPrendLeNomCuisine()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur renomme la catégorie avec le nom radiophonie en radio
   */
  public function lutilisateurRenommeLaCategorieAvecLeNomRadiophonieEnRadio()
  {
    throw new PendingException();
  }

  /**
   * @Then l'ancienne catégorie radiophonie prend le nom radio
   */
  public function lancienneCategorieRadiophoniePrendLeNomRadio()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur renomme la catégorie avec le nom concert en musique
   */
  public function lutilisateurRenommeLaCategorieAvecLeNomConcertEnMusique()
  {
    throw new PendingException();
  }

  /**
   * @Then l'ancienne catégorie concert prend le nom musique
   */
  public function lancienneCategorieConcertPrendLeNomMusique()
  {
    throw new PendingException();
  }

  /**
   * @Given la liste de catégories contient cuisine
   */
  public function laListeDeCategoriesContientCuisine()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur supprime la catégorie cuisine
   */
  public function lutilisateurSupprimeLaCategorieCuisine()
  {
    throw new PendingException();
  }

  /**
   * @Then la catégorie cuisine disparaît
   */
  public function laCategorieCuisineDisparait()
  {
    throw new PendingException();
  }

  /**
   * @Given la liste de catégories contient téléphone
   */
  public function laListeDeCategoriesContientTelephone()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur supprime la catégorie téléphone
   */
  public function lutilisateurSupprimeLaCategorieTelephone()
  {
    throw new PendingException();
  }

  /**
   * @Then la catégorie téléphone disparaît
   */
  public function laCategorieTelephoneDisparait()
  {
    throw new PendingException();
  }

  /**
   * @Given la liste de catégories contient jeux vidéos
   */
  public function laListeDeCategoriesContientJeuxVideos()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur supprime la catégorie jeux vidéos
   */
  public function lutilisateurSupprimeLaCategorieJeuxVideos()
  {
    throw new PendingException();
  }

  /**
   * @Then la catégorie jeux vidéos disparaît
   */
  public function laCategorieJeuxVideosDisparait()
  {
    throw new PendingException();
  }
}
