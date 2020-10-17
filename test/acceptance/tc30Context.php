<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc30Context implements Context
{
  /**
   * @Given L'utilisateur est sur la page de création de compte.
   */
  public function lutilisateurEstSurLaPageDeCreationDeCompte()
  {
    throw new PendingException();
  }

  /**
   * @When L'utilisateur renseigne les champs de saisies.
   */
  public function lutilisateurRenseigneLesChampsDeSaisies()
  {
    throw new PendingException();
  }

  /**
   * @When L'utilisateur valide son inscription.
   */
  public function lutilisateurValideSonInscription()
  {
    throw new PendingException();
  }

  /**
   * @Then Le compte de l'utilisateur est enregistré.
   */
  public function leCompteDeLutilisateurEstEnregistre()
  {
    throw new PendingException();
  }
}
