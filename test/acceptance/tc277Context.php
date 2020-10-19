<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc277Context implements Context
{
  /**
   * @Given l'utilisateur est sur la messagerie
   */
  public function lutilisateurEstSurLaMessagerie()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur envoie un message
   */
  public function lutilisateurEnvoieUnMessage()
  {
    throw new PendingException();
  }

  /**
   * @Then le message est transmis au destinataire
   */
  public function leMessageEstTransmisAuDestinataire()
  {
    throw new PendingException();
  }
}
