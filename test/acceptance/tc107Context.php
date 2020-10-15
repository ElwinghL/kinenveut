<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc107Context implements Context
{
  /**
   * @Given l'utilisateur est sur la page de gestion d'une enchère
   */
  public function lutilisateurEstSurLaPageDeGestionDuneEnchere()
  {
    throw new PendingException();
  }

  /**
   * @Given l'utilisateur est un administrateur de l'enchère
   */
  public function lutilisateurEstUnAdministrateurDeLenchere()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur clique sur le bouton d'éjection d'un acheteur
   */
  public function lutilisateurCliqueSurLeBoutonDejectionDunAcheteur()
  {
    throw new PendingException();
  }

  /**
   * @Then cet acheteur ne fait plus partie de l'enchère
   */
  public function cetAcheteurNeFaitPlusPartieDeLenchere()
  {
    throw new PendingException();
  }

  /**
   * @Then l'acheteur éjecté n'y a plus accès
   */
  public function lacheteurEjecteNyAPlusAcces()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur clique sur le bouton de suppression du bannissement d'un acheteur
   */
  public function lutilisateurCliqueSurLeBoutonDeSuppressionDuBannissementDunAcheteur()
  {
    throw new PendingException();
  }

  /**
   * @Then cet acheteur a de nouveau accès à l'enchère
   */
  public function cetAcheteurADeNouveauAccesALenchere()
  {
    throw new PendingException();
  }
}
