<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc160Context implements Context
{
  /**
   * @When l'utilisateur clique sur le bouton d'envoi de l'enchère
   */
  public function lutilisateurCliqueSurLeBoutonDenvoiDeLenchere()
  {
    throw new PendingException();
  }

  /**
   * @When l'enchère est fermée
   */
  public function lenchereEstFermee()
  {
    throw new PendingException();
  }

  /**
   * @Then un message d'erreur est affiché
   */
  public function unMessageDerreurEstAffiche()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur a choisi un montant invalide
   */
  public function lutilisateurAChoisiUnMontantInvalide()
  {
    throw new PendingException();
  }
}
