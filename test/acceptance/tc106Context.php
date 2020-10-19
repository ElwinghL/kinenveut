<?php

use Behat\Behat\Context\Context;

include_once 'test/acceptance/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc106Context implements Context
{
  /**
   * @Given L'utilisateur est normal
   */
  public function lutilisateurEstNormal()
  {
    $user = new UserModel();
    $user
      ->setFirstName('Francis')
      ->setLastName('Dupont')
      ->setBirthDate(DateTime::createFromFormat('d/m/Y', '22/12/1999'))
      ->setEmail('francis.dupont@gmail.com')
      ->setPassword('password');

    Universe::getUniverse()->setUser($user);
  }

  /**
   * @Given L'utilisateur a posté des enchères.
   */
  public function lutilisateurAPosteDesEncheres()
  {
    $session = Universe::getUniverse()->getSession();

    visitCreateAuction($session);

    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette sale');
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();
  }

  /**
   * @When L'utilisateur consulte ses enchères.
   */
  public function lutilisateurConsulteSesEncheres()
  {
    $session = Universe::getUniverse()->getSession();

    visitSells($session);
  }

  /**
   * @Then L'utilisateur voit toutes les enchères qu'il a posté.
   */
  public function lutilisateurVoitToutesLesEncheresQuilAPoste()
  {
    $session = Universe::getUniverse()->getSession();

    if ($session->getPage()->find(
      'css',
      '.auction-name'
    )->getText() != 'Chaussette sale') {
      throw new Exception('auction was not found');
    }

    Universe::getUniverse()->setToDelete(['users' => [Universe::getUniverse()->getUser()]]);
  }
}
