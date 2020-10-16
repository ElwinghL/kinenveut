<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc289Context implements Context
{
  /**
   * @When l'utilisateur modifie les données de l'enchère
   */
  public function lutilisateurModifieLesDonneesDeLenchere()
  {
    throw new PendingException();
  }

  /**
   * @Then cette enchère est mise à jour
   */
  public function cetteEnchereEstMiseAJour()
  {
    throw new PendingException();
  }
}
