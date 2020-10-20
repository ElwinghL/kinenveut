<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc32Context implements Context
{
  /**
   * @When l'utilisateur choisis une catégorie
   */
  public function lutilisateurChoisisUneCategorie()
  {
    $session = Universe::getUniverse()->getSession();

    $session->getPage()->find(
      'css',
      '#categoryId'
    )->selectOption(1);
  }
}
