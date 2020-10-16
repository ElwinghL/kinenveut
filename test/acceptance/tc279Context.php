<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc279Context implements Context
{
  /**
   * @Given l'utilisateur a été invité à cette enchère
   */
  public function lutilisateurAEteInviteACetteEnchere()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur recherche une vente confidentielle existant dans la base de données
   */
  public function lutilisateurRechercheUneVenteConfidentielleExistantDansLaBaseDeDonnees()
  {
    throw new PendingException();
  }
}
