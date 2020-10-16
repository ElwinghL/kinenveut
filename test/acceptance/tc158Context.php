<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

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
    $session->visit('http://localhost/kinenveut/?r=userManagement');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=userManagement') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=userManagement"');
    }
  }

  /**
   * @Given la liste des users contient Auréchou
   */
  public function laListeDesUsersContientAurechou()
  {
    $session = Universe::getUniverse()->getSession();

    $session->visit('http://localhost/kinenveut/?r=userManagement');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=userManagement') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=userManagement"');
    }
    if ($session->getPage()->find(
      'css',
      '.list-group-item'
    )->getText() != 'Auréchou') {
      throw new Exception('user was not found');
    }
  }

  /**
   * @When l'admin bannit Auréchou
   */
  public function ladminBannitAurechou()
  {
    throw new PendingException();
  }

  /**
   * @Then l'utilisateur Auréchou est banni
   */
  public function lutilisateurAurechouEstBanni()
  {
    throw new PendingException();
  }

  /**
   * @Given la liste des users contient Waxel
   */
  public function laListeDesUsersContientWaxel()
  {
    throw new PendingException();
  }

  /**
   * @When l'admin bannit Waxel
   */
  public function ladminBannitWaxel()
  {
    throw new PendingException();
  }

  /**
   * @Then l'utilisateur Waxel est banni
   */
  public function lutilisateurWaxelEstBanni()
  {
    throw new PendingException();
  }

  /**
   * @Given la liste des users contient Gauthier
   */
  public function laListeDesUsersContientGauthier()
  {
    throw new PendingException();
  }

  /**
   * @When l'admin bannit Gauthier
   */
  public function ladminBannitGauthier()
  {
    throw new PendingException();
  }

  /**
   * @Then l'utilisateur Gauthier est banni
   */
  public function lutilisateurGauthierEstBanni()
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
