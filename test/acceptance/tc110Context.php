<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc110Context implements Context
{
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
   * @When il clique sur le bouton rechercher
   */
  public function ilCliqueSurLeBoutonRechercher()
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
