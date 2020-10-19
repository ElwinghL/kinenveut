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
   * @Given L'utilisateur est sur la page de création de compte.
   */
  public function lutilisateurEstSurLaPageDeCreationDeCompte()
  {
    $session = Universe::getUniverse()->getSession();
    $session->visit('http://localhost/kinenveut/');
    checkUrl($session, 'http://localhost/kinenveut/?r=login');

    $session->getPage()->find(
      'css',
      'a[href="?r=registration"]'
    )->click();

    checkUrl($session, 'http://localhost/kinenveut/?r=registration');
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
  }

  /**
   * @Then Le compte de l'utilisateur est enregistré.
   */
  public function leCompteDeLutilisateurEstEnregistre()
  {
    $session = Universe::getUniverse()->getSession();

    checkUrl($session, 'http://localhost/kinenveut/?r=login');

    Universe::getUniverse()->setCanDelete(['user' => true]);
  }

  /**
   * @Given l'utilisateur est déjà inscrit
   */
  public function lutilisateurEstDejaInscrit()
  {
    $session = Universe::getUniverse()->getSession();
    $session->visit('http://localhost/kinenveut/');

    checkUrl($session, 'http://localhost/kinenveut/?r=login');

    $session->getPage()->find(
      'css',
      'a[href="?r=registration"]'
    )->click();

    checkUrl($session, 'http://localhost/kinenveut/?r=registration');

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

    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();

    Universe::getUniverse()->setCanDelete(['user' => true]);
  }

  /**
   * @Then L'utilisateur reçoit un message d'erreur lui indiquant que l'adresse mail qu'il a saisie est déjà utilisée
   */
  public function lutilisateurRecoitUnMessageDerreurLuiIndiquantQueLadresseMailQuilASaisieEstDejaUtilisee()
  {
    $session = Universe::getUniverse()->getSession();

    checkUrl($session, 'http://localhost/kinenveut/?r=registration/register');

    if ($session->getPage()->find(
      'css',
      '.invalid-feedback.d-block'
    )->getText() != 'L\'adresse mail est déjà utilisée par un autre utilisateur') {
      throw new Exception('There is not an error');
    }
  }
}
