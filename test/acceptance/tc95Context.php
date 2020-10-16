<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc95Context implements Context
{
  /**
   * @When l'utilisateur consulte la liste de catégories
   */
  public function lutilisateurConsulteLaListeDeCategories()
  {
    throw new PendingException();
  }

  /**
   * @Then la liste des catégories est visible
   */
  public function laListeDesCategoriesEstVisible()
  {
    throw new PendingException();
  }
}
