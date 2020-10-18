<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc63Context implements Context
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
   * @When l'utilisateur valide son enchère avec les champs invalides (prix de départ, pris de réserve)
   */
  public function lutilisateurValideSonEnchereAvecLesChampsInvalidesPrixDeDepartPrisDeReserve()
  {
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette invalide');
    $session->getPage()->find(
      'css',
      'input[name="basePrice"]'
    )->setValue(2);
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();
  }

  /**
   * @Then l'enchère n'est pas créée
   */
  public function lenchereNestPasCreee()
  {
    $session = Universe::getUniverse()->getSession();
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=auction/saveObjectAuction') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=auction/saveObjectAuction"');
    }
    Universe::getUniverse()->setCanDelete(['user'=>true]);
  }
}
