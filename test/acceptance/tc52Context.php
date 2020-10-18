<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc52Context implements Context
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
   * @Given l'utilisateur est sur la page de création d'enchère
   */
  public function lutilisateurEstSurLaPageDeCreationDenchere()
  {
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      '#dropdownMenuButton'
    )->click();
    $session->getPage()->find(
      'css',
      '#menuCreateAuction'
    )->click();
    if ($session->getStatusCode() !== 200) {
      throw new Exception('status code is not 200');
    }
    if ($session->getCurrentUrl() !== 'http://localhost/kinenveut/?r=auction/create') {
      throw new Exception('url is not "http://localhost/kinenveut/?r=auction/create"');
    }
  }

  /**
   * @When l'utilisateur valide son enchère avec les champs valides (prix de départ, pris de réserve)
   */
  public function lutilisateurValideSonEnchereAvecLesChampsValidesPrixDeDepartPrisDeReserve()
  {
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette');
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();
  }

  /**
   * @Then une enchère est créée
   */
  public function uneEnchereEstCreee()
  {
    throw new PendingException();
  }
}
