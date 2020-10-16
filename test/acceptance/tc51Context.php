<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

include_once 'src/tools.php';

/**
 * Defines application features from the specific context.
 */
class tc51Context implements Context
{
  /**
   * @Given l'utilisateur est connecté sur la page admin
   */
  public function lutilisateurEstConnecteSurLaPageAdmin()
  {
    $session = Universe::getUniverse()->getSession();
    $user = Universe::getUniverse()->getUser();
    $session->visit('http://localhost/kinenveut/');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }
    $session->getPage()->find(
      'css',
      'input[name="email"]'
    )->setValue($user->getEmail());
    $session->getPage()->find(
      'css',
      'input[name="password"]'
    )->setValue($user->getPassword());
    $session->getPage()->find(
      'css',
      'input[name="connection"]'
    )->click();

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=home') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=home"');
    }
  }

  /**
   * @When l'utilisateur consulte la liste des enchères
   */
  public function lutilisateurConsulteLaListeDesEncheres()
  {
    throw new PendingException();
  }

  /**
   * @Then la liste des enchères publiques est visible
   */
  public function laListeDesEncheresPubliquesEstVisible()
  {
    throw new PendingException();
  }

  /**
   * @Then la liste des enchères privées est visible
   */
  public function laListeDesEncheresPriveesEstVisible()
  {
    throw new PendingException();
  }

  /**
   * @Then la liste des enchères confidentielles est visible
   */
  public function laListeDesEncheresConfidentiellesEstVisible()
  {
    throw new PendingException();
  }
}
