<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc288Context implements Context
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
   * @Given l'utilisateur est sur la page de gestion de ses enchères
   */
  public function lutilisateurEstSurLaPageDeGestionDeSesEncheres()
  {
    throw new PendingException();
  }

  /**
   * @Given l'utilisateur est un administrateur de l'enchère ciblée
   */
  public function lutilisateurEstUnAdministrateurDeLenchereCiblee()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur clique sur le bouton de suppression d'une enchère
   */
  public function lutilisateurCliqueSurLeBoutonDeSuppressionDuneEnchere()
  {
    throw new PendingException();
  }

  /**
   * @When l'enchère existe
   */
  public function lenchereExiste()
  {
    throw new PendingException();
  }

  /**
   * @Then cette enchère est supprimée
   */
  public function cetteEnchereEstSupprimee()
  {
    throw new PendingException();
  }
}
