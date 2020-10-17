<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc280Context implements Context
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
   * @When l'utilisateur choisit une visibilité
   */
  public function lutilisateurChoisitUneVisibilite()
  {
    $session = Universe::getUniverse()->getSession();

    $session->getPage()->find(
      'css',
      '#privacyId'
    )->selectOption(1);
  }

  /**
   * @Then le résultat de sa recherche est affiché
   */
  public function leResultatDeSaRechercheEstAffiche()
  {
    //Todo : Atention, on ne sait pas s'il existe ou non des enchères :)
    $session = Universe::getUniverse()->getSession();

    $url = 'http://localhost/kinenveut/?r=home/search';
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== $url) {
      throw new Exception('url is not "' . $url . '"');
    }

    if ($session->getPage()->find(
      'css',
      '.auctions-list-custom'
    ) == false) {
      throw new Exception('The auction list was not found');
    }

    Universe::getUniverse()->setCanDelete(['user' => true]);
  }
}
