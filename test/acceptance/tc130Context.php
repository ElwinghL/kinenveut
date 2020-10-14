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
   * @Then les enchères avec la catégorie cuisine sont remis à la catégorie par défaut
   */
  public function lesEncheresAvecLaCategorieCuisineSontRemisALaCategorieParDefaut()
  {
    throw new PendingException();
  }

  /**
   * @Given la liste de catégories contient autres
   */
  public function laListeDeCategoriesContientAutres()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur supprime la catégorie autres
   */
  public function lutilisateurSupprimeLaCategorieAutres()
  {
    throw new PendingException();
  }

  /**
   * @Then les enchères avec la catégorie autres sont remis à la catégorie par défaut
   */
  public function lesEncheresAvecLaCategorieAutresSontRemisALaCategorieParDefaut()
  {
    throw new PendingException();
  }

  /**
   * @Given la liste de catégories contient encombrant
   */
  public function laListeDeCategoriesContientEncombrant()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur supprime la catégorie encombrant
   */
  public function lutilisateurSupprimeLaCategorieEncombrant()
  {
    throw new PendingException();
  }

  /**
   * @Then les enchères avec la catégorie encombrant sont remis à la catégorie par défaut
   */
  public function lesEncheresAvecLaCategorieEncombrantSontRemisALaCategorieParDefaut()
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
