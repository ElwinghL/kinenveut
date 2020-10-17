<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc133Context implements Context
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
   * @Given L'utilisateur n'est pas connecté
   */
  public function lutilisateurNestPasConnecte()
  {
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur à un compte dans la base
   */
  public function lutilisateurAUnCompteDansLaBase()
  {
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur a entré son adresse mail.
   */
  public function lutilisateurAEntreSonAdresseMail()
  {
    throw new PendingException();
  }

  /**
   * @When L'utilisateur a oublié son mot de passe
   */
  public function lutilisateurAOublieSonMotDePasse()
  {
    throw new PendingException();
  }

  /**
   * @Then L'utilisateur recoit un email avec la possibilité de récupérer l'accès à son compte
   */
  public function lutilisateurRecoitUnEmailAvecLaPossibiliteDeRecupererLaccesASonCompte()
  {
    throw new PendingException();
  }

  /**
   * @Given L'utilisateur n'a pas de compte dans la base
   */
  public function lutilisateurNaPasDeCompteDansLaBase()
  {
    throw new PendingException();
  }

  /**
   * @Then L'utilisateur reçoit un message d'erreur approprié.
   */
  public function lutilisateurRecoitUnMessageDerreurApproprie()
  {
    throw new PendingException();
  }
}
