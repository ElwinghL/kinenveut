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
   * @Given L'utilisateur n'est pas connecté
   */
  public function lutilisateurNestPasConnecte()
  {
    $session = Universe::getUniverse()->getSession();

    $session->visit('http://localhost/kinenveut/');

    checkUrl('http://localhost/kinenveut/?r=login');
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
    Universe::getUniverse()->setToDelete(['users' => [Universe::getUniverse()->getUser()]]);
    //Non testable
    // throw new PendingException();
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
    Universe::getUniverse()->setToDelete(['users' => [Universe::getUniverse()->getUser()]]);
    $session = Universe::getUniverse()->getSession();

    $url = 'http://localhost/kinenveut/?r=login/login';
    checkUrl($url);

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
