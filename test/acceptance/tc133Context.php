<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

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
    $canDelete = Universe::getUniverse()->getCanDelete();
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    if (isset($canDelete['user'])) {
      $user = $userDao->selectUserByEmail(Universe::getUniverse()->getUser()->getEmail());
      if ($user != null) {
        $isAdmin = $user->getIsAdmin();
        if ($isAdmin == false) {
          $userDao->deleteUser($user->getId());
        }
      }
      unset($canDelete['user']);
      Universe::getUniverse()->setCanDelete($canDelete);
    }
  }

  /**
   * @Given L'utilisateur n'est pas connecté
   */
  public function lutilisateurNestPasConnecte()
  {
    $session = Universe::getUniverse()->getSession();
    $session->visit('http://localhost/kinenveut/');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }
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
   * @Then L'utilisateur reçoit un message d'erreur approprié.
   */
  public function lutilisateurRecoitUnMessageDerreurApproprie()
  {
    //Todo : ATTENTION, cette foncition est utilisée à plusieurs endroits à tord
    Universe::getUniverse()->setCanDelete(['user'=>true]);
    throw new PendingException();
    $session = Universe::getUniverse()->getSession();

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=registration') {
      throw new Exception(' url is not "http://localhost/kinenveut/?r=registration"');
    }

    if ($session->getPage()->find(
      'css',
      '.invalid-feedback.d-block'
    )->getText() != 'L\'adresse mail est déjà utilisée par un autre utilisateur') {
      throw new Exception('There is not an error');
    }
  }
}
