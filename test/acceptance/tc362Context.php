<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc362Context implements Context
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
    /* Création de l'utilisateur à valider */
    $user = new UserModel();
    $user->setFirstName("Jean")->setLastName("Michou")->setEmail("jeanmi@gmail.com")->setPassword("password")->setBirthDate(new DateTime("2005-05-05"));
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userId = $userBo->insertUser($user);
    $user->setPassword("password");
    $user->setId($userId);
    Universe::getUniverse()->setUser2($user);
  }

  public function __destruct()
  {
    /* Suppression de l'utilisateur validé */
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $userBo->deleteUser(Universe::getUniverse()->getUser2()->getId());
  }

  /**
   * @Given une demande d'inscription est présente
   */
  public function uneDemandeDinscriptionEstPresente()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      '.list-group-item'
    )->getText() != "(En Attente) Jean Michou") {
      throw new Exception('the user is not on the validation list');
    }
  }

  /**
   * @When l'admin valide l'inscription
   */
  public function ladminValideLinscription()
  {
    $session = Universe::getUniverse()->getSession();

    $session->getPage()->find(
      'css',
      '.btn.btn-success'
    )->click();

    if ($session->getPage()->find(
      'css',
      '.list-group-item'
    )->getText() == "(En Attente) Jean Michou") {
      throw new Exception('the user was not accepted');
    }
  }

  /**
   * @Then l'inscription de l'utilisateur devient effective
   */
  public function linscriptionDeLutilisateurDevientEffective()
  {
    $session = Universe::getUniverse()->getSession();

    disconnect($session);

    connect($session, Universe::getUniverse()->getUser2());
  }
}
