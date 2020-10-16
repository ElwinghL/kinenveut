<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc36Context implements Context
{
  /**
   * @When l'utilisateur tente d'entrer sans nom d'utilisateur ou mot de passe
   */
  public function lutilisateurTenteDentrerSansNomDutilisateurOuMotDePasse()
  {
    throw new PendingException();
  }
}
