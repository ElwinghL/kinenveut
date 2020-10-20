<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';
/**
 * Defines application features from the specific context.
 */
class tc158Context implements Context
{
  /**
   * @Given l'utilisateur consulte les users
   */
  public function lutilisateurConsulteLesUsers()
  {
    $session = Universe::getUniverse()->getSession();

    visitUserManagment($session);
  }

  /**
   * @Given la liste des users contient :arg1
   */
  public function laListeDesUsersContient($arg1)
  {
    $session = Universe::getUniverse()->getSession();

    visitUserManagment($session);

    if ($session->getPage()->find(
      'css',
      '.list-group-item'
    )->getText() != $arg1) {
      throw new Exception('user was not found');
    }
  }

  /**
   * @When l'administrateur banni un utilisateur
   */
  public function ladministrateurBanniUnUtilisateur()
  {
    throw new PendingException();
  }

  /**
   * @Then les offres en cours de l'utilisateur sont supprimées
   */
  public function lesOffresEnCoursDeLutilisateurSontSupprimees()
  {
    throw new PendingException();
  }

  /**
   * @Then les enchères de l'utilisateur sont supprimées
   */
  public function lesEncheresDeLutilisateurSontSupprimees()
  {
    throw new PendingException();
  }
}
