<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc31Context implements Context
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
   * @When l'utilisateur entre une paire nom\/mdp valide
   */
  public function lutilisateurEntreUnePaireNomMdpValide()
  {
    throw new PendingException();
  }

  /**
   * @Then l'accès admin est accordé
   */
  public function laccesAdminEstAccorde()
  {
    throw new PendingException();
  }
}
