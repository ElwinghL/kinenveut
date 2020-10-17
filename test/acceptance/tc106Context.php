<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc106Context implements Context
{
  /**
   * @Given L'utilisateur est normal
   */
  public function lutilisateurEstNormal()
  {
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur a posté des enchères.
   */
  public function lutilisateurAPosteDesEncheres()
  {
    throw new PendingException();
  }

  /**
   * @When L'utilisateur consulte ses enchères.
   */
  public function lutilisateurConsulteSesEncheres()
  {
    throw new PendingException();
  }

  /**
   * @Then L'utilisateur voit toutes les enchères qu'il a posté.
   */
  public function lutilisateurVoitToutesLesEncheresQuilAPoste()
  {
    throw new PendingException();
  }
}
