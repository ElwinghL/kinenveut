<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc38Context implements Context
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
   * @When l'utilisateur entre un prix de départ invalide
   */
  public function lutilisateurEntreUnPrixDeDepartInvalide()
  {
    throw new PendingException();
  }

  /**
   * @Then la création d'enchère est impossible
   */
  public function laCreationDenchereEstImpossible()
  {
    throw new PendingException();
  }
}
