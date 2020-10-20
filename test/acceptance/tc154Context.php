<?php

use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc154Context implements Context
{
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
    visitUserManagment($session);
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
  }
}
