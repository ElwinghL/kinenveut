<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc114Context implements Context
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
   * @Given l'utilisateur est enregistré sur le site
   */
  public function lutilisateurEstEnregistreSurLeSite()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur recherche une vente privée existant dans la base de données
   */
  public function lutilisateurRechercheUneVentePriveeExistantDansLaBaseDeDonnees()
  {
    throw new PendingException();
  }
}
