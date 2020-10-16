<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc154Context implements Context
{
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
