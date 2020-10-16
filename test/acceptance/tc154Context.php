<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc154Context implements Context
{
  /**
   * @Given l'utilisateur est un administrateur
   */
  public function lutilisateurEstUnAdministrateur()
  {
    throw new PendingException();
  }

  /**
   * @Given l'utilisateur se connecte
   */
  public function lutilisateurSeConnecte()
  {
    throw new PendingException();
  }

  /**
   * @Given il existe un ou plusieurs membres en attente de validation d'inscription
   */
  public function ilExisteUnOuPlusieursMembresEnAttenteDeValidationDinscription()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur consulte la liste des utilisateurs en attente d'inscription
   */
  public function lutilisateurConsulteLaListeDesUtilisateursEnAttenteDinscription()
  {
    throw new PendingException();
  }

  /**
   * @Then la liste des utilisateurs est visible
   */
  public function laListeDesUtilisateursEstVisible()
  {
    throw new PendingException();
  }
}
