<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc23Context implements Context
{
  /**
   * @Given L'utilisateur est sur la page de connexion admin
   */
  public function lutilisateurEstSurLaPageDeConnexionAdmin()
  {
    $session = Universe::getUniverse()->getSession();
    $session->visit('http://localhost/kinenveut/');
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=login') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=login"');
    }
  }

  /**
   * @When l'utilisateur entre une paire nom\/mdp invalide
   */
  public function lutilisateurEntreUnePaireNomMdpInvalide()
  {
    throw new PendingException();
  }

  /**
   * @Then l'accès admin est refusé
   */
  public function laccesAdminEstRefuse()
  {
    throw new PendingException();
  }
}
