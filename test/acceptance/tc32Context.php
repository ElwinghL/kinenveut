<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc32Context implements Context
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
