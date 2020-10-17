<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc110Context implements Context
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
   * @Given L'utilisateur est sur la page de recherche
   */
  public function lutilisateurEstSurLaPageDeRecherche()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur recherche une vente publique existant dans la base de donnée
   */
  public function lutilisateurRechercheUneVentePubliqueExistantDansLaBaseDeDonnee()
  {
    throw new PendingException();
  }

  /**
   * @When L'utilisateur clique sur le bouton rechercher
   */
  public function lutilisateurCliqueSurLeBoutonRechercher()
  {
    throw new PendingException();
  }

  /**
   * @Then il trouve cette enchère
   */
  public function ilTrouveCetteEnchere()
  {
    throw new PendingException();
  }
}
