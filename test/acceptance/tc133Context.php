<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc133Context implements Context
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
    deleteUserUniverse();
  }

  /**
   * @Given L'utilisateur n'est pas connecté
   */
  public function lutilisateurNestPasConnecte()
  {
    $session = Universe::getUniverse()->getSession();

    $session->visit('http://localhost/kinenveut/');

    $url = 'http://localhost/kinenveut/?r=login';
    checkUrl($session, $url);
  }

  /**
   * @Given L'utilisateur à un compte dans la base
   */
  public function lutilisateurAUnCompteDansLaBase()
  {
    $session = Universe::getUniverse()->getSession();

    /*Create a new user*/
    $localUser = new UserModel();
    $localUser
          ->setFirstName('Capucine')
          ->setLastName('Dupont')
          ->setBirthDate(DateTime::createFromFormat('d/m/Y', '01/06/1995'))
          ->setEmail('capucine.dupont@kinenveut.fr')
          ->setPassword('password');

    Universe::getUniverse()->setUser($localUser);

    visitRegistrationPage($session);

    suscribe($session, $localUser);
  }

  /**
   * @Given L'utilisateur a entré son adresse mail.
   */
  public function lutilisateurAEntreSonAdresseMail()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();

    /*Fill the form*/
    $session->getPage()->find(
      'css',
      'input[name="email"]'
    )->setValue($user->getEmail());
  }

  /**
   * @When L'utilisateur a oublié son mot de passe
   */
  public function lutilisateurAOublieSonMotDePasse()
  {
    //Non testable (on est pas dans la tête de l'utilisateur)
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[name="password"]'
    )->setValue('');

    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();
  }

  /**
   * @Then L'utilisateur recoit un email avec la possibilité de récupérer l'accès à son compte
   */
  public function lutilisateurRecoitUnEmailAvecLaPossibiliteDeRecupererLaccesASonCompte()
  {
    Universe::getUniverse()->setCanDelete(['user'=>true]);
    //Non testable
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur n'a pas de compte dans la base
   */
  public function lutilisateurNaPasDeCompteDansLaBase()
  {
    /*Create a new user*/
    $localUser = new UserModel();
    $localUser
          ->setFirstName('Capucine')
          ->setLastName('Dupont')
          ->setBirthDate(DateTime::createFromFormat('d/m/Y', '01/06/1995'))
          ->setEmail('capucine.dupont@kinenveut.fr')
          ->setPassword('password');

    Universe::getUniverse()->setUser($localUser);

    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());

    if ($user != null) {
      throw new Exception('The user already exists');
    }
  }

  /**
     * @Then L'utilisateur reçoit un message lui indiquant qu'aucune adresse mail ne corresponds à l'adresse mail saisie
     */
  public function lutilisateurRecoitUnMessageLuiIndiquantQuaucuneAdresseMailNeCorrespondsALadresseMailSaisie()
  {
    Universe::getUniverse()->setCanDelete(['user'=>true]);
    $session = Universe::getUniverse()->getSession();

    $url = 'http://localhost/kinenveut/?r=login/login';
    checkUrl($session, $url);

    if ($session->getPage()->find(
      'css',
      '.invalid-feedback.d-block'
    ) == false) {
      throw new Exception('The error div is missing');
    }
    if ($session->getPage()->find(
      'css',
      '.invalid-feedback.d-block'
    )->getText() != 'Identifiants incorrects') {
      throw new Exception('There is returned error is not the expected one');
    }
  }
}
