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
    throw new PendingException();
  }

  /**
   * @When l'utilisateur valide son enchère avec les champs valides (prix de départ, pris de réserve)
   */
  public function lutilisateurValideSonEnchereAvecLesChampsValidesPrixDeDepartPrisDeReserve()
  {
    throw new PendingException();
  }

  /**
   * @Then une enchère est créée
   */
  public function uneEnchereEstCreee()
  {
    throw new PendingException();
  }
}
