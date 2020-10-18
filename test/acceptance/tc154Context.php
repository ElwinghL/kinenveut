<?php

include_once 'test/acceptance/tools.php';
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
    deleteUser2Universe();
  }

  /**
   * @Given il existe un ou plusieurs membres en attente de validation d'inscription
   */
  public function ilExisteUnOuPlusieursMembresEnAttenteDeValidationDinscription()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();

    disconnect($session);

    /*Create a new user*/
    $localUser = new UserModel();
    $localUser
          ->setFirstName('Capucine')
          ->setLastName('Dupont')
          ->setBirthDate(DateTime::createFromFormat('d/m/Y', '01/06/1995'))
          ->setEmail('capucine.dupont@kinenveut.fr')
          ->setPassword('password');

    Universe::getUniverse()->setUser2($localUser);

    visitRegistrationPage($session);

    suscribe($session, Universe::getUniverse()->getUser2());
    connect($session, Universe::getUniverse()->getUser());
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
