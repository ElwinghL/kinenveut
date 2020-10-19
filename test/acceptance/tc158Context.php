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
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct()
  {
  }

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
   * @When l'admin bannit :arg1
   */
  public function ladminBannit($arg1)
  {
    $url = 'http://localhost/kinenveut/?r=account/index&userId=' . $user->getId();
    throw new PendingException();
  }

  /**
   * @Then l'utilisateur :arg1 est banni
   */
  public function lutilisateurEstBanni($arg1)
  {
    throw new PendingException();
  }

  /**
   * @Given l'utilisateur toto a une enchère
   */
  public function lutilisateurTotoAUneEnchere()
  {
    throw new PendingException();
  }

  /**
   * @When l'admin bannit toto
   */
  public function ladminBannitToto()
  {
    throw new PendingException();
  }

  /**
   * @Then les offres de toto sont supprimées
   */
  public function lesOffresDeTotoSontSupprimees()
  {
    throw new PendingException();
  }

  /**
   * @Then les enchères de toto sont supprimées
   */
  public function lesEncheresDeTotoSontSupprimees()
  {
    throw new PendingException();
  }
}
