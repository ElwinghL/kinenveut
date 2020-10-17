<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc130Context implements Context
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
