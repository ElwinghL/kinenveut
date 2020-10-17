<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc274Context implements Context
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
   * @Given l'utilisateur a reçu au moins un message
   */
  public function lutilisateurARecuAuMoinsUnMessage()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur consulte la messagerie
   */
  public function lutilisateurConsulteLaMessagerie()
  {
    throw new PendingException();
  }

  /**
   * @Then les messages sont affichés
   */
  public function lesMessagesSontAffiches()
  {
    throw new PendingException();
  }

  /**
   * @Given l'utilisateur n'a reçu aucun message
   */
  public function lutilisateurNaRecuAucunMessage()
  {
    throw new PendingException();
  }

  /**
   * @Given un autre utilisateur a reçu un message
   */
  public function unAutreUtilisateurARecuUnMessage()
  {
    throw new PendingException();
  }

  /**
   * @Then aucun message n'est affiché
   */
  public function aucunMessageNestAffiche()
  {
    throw new PendingException();
  }
}
