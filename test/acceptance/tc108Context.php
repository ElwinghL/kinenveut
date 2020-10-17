<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc108Context implements Context
{
  /**
   * @Given L'utilisateur est sur la page de connexion
   */
  public function lutilisateurEstSurLaPageDeConnexion()
  {
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur entre son adresse mail
   */
  public function lutilisateurEntreSonAdresseMail()
  {
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur entre son mot de passe
   */
  public function lutilisateurEntreSonMotDePasse()
  {
    throw new PendingException();
  }

  /**
   * @When Clique sur le bouton :arg1
   */
  public function cliqueSurLeBouton($arg1)
  {
    throw new PendingException();
  }

  /**
   * @Then L'utilisateur est identifié sur le site
   */
  public function lutilisateurEstIdentifieSurLeSite()
  {
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur se trompe d'adresse mail
   */
  public function lutilisateurSeTrompeDadresseMail()
  {
    throw new PendingException();
  }

  /**
   * @When L'utilisateur clique sur le bouton :arg1
   */
  public function lutilisateurCliqueSurLeBouton($arg1)
  {
    throw new PendingException();
  }

  /**
   * @Then L'utilisateur reçoit un message d'erreur approprié
   */
  public function lutilisateurRecoitUnMessageDerreurApproprie()
  {
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur se trompe de mot de passe
   */
  public function lutilisateurSeTrompeDeMotDePasse()
  {
    throw new PendingException();
  }
}
