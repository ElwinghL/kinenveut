<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc154Context implements Context
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
   * @When l'utilisateur consulte la liste des utilisateurs
   */
  public function lutilisateurConsulteLaListeDesUtilisateurs()
  {
    throw new PendingException();
  }

  /**
   * @Then la liste des utilisateurs est visible
   */
  public function laListeDesUtilisateursEstVisible()
  {
    throw new PendingException();
  }
}
