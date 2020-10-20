<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc130Context implements Context
{
  /**
   * @Then les enchères avec la catégorie :arg1 sont remis à la catégorie par défaut
   */
  public function lesEncheresAvecLaCategorieSontRemisALaCategorieParDefaut($arg1)
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur veut supprimer la catégorie par défaut
   */
  public function lutilisateurVeutSupprimerLaCategorieParDefaut()
  {
    throw new PendingException();
  }

  /**
   * @Then la suppression ne fonctionne pas
   */
  public function laSuppressionNeFonctionnePas()
  {
    throw new PendingException();
  }
}
