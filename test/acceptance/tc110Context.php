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
    $session = Universe::getUniverse()->getSession();
    $url = 'http://localhost/kinenveut/?r=home';
    $session->visit($url);

    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== $url) {
      throw new Exception('url is not "' . $url . '"');
    }
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
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[type="submit"]'
    )->click();
  }

  /**
   * @Then il trouve cette enchère
   */
  public function ilTrouveCetteEnchere()
  {
    throw new PendingException();
  }
}
