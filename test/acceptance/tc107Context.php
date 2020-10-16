<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc107Context implements Context
{
  /**
   * @Given l'utilisateur est un administrateur de l'enchère
   */
  public function lutilisateurEstUnAdministrateurDeLenchere()
  {
    throw new PendingException();
  }

  /**
   * @Given il accèdes à la page des demandes d'accès à ses enchères
   */
  public function ilAccedesALaPageDesDemandesDaccesASesEncheres()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur clique sur le bouton d'éjection d'une personne ayant demandée à participer à l'enchère
   */
  public function lutilisateurCliqueSurLeBoutonDejectionDunePersonneAyantDemandeeAParticiperALenchere()
  {
    throw new PendingException();
  }

  /**
   * @Then cette personne est refusée
   */
  public function cettePersonneEstRefusee()
  {
    throw new PendingException();
  }

  /**
   * @Then ne peut pas participer à cette enchère privée
   */
  public function nePeutPasParticiperACetteEncherePrivee()
  {
    throw new PendingException();
  }

  /**
   * @When l'utilisateur clique sur le bouton d'acceptation d'une personne ayant demandée à participer à l'enchère
   */
  public function lutilisateurCliqueSurLeBoutonDacceptationDunePersonneAyantDemandeeAParticiperALenchere()
  {
    throw new PendingException();
  }

  /**
   * @Then cette personne est acceptée
   */
  public function cettePersonneEstAcceptee()
  {
    throw new PendingException();
  }

  /**
   * @Then peut alors participer à cette enchère privée
   */
  public function peutAlorsParticiperACetteEncherePrivee()
  {
    throw new PendingException();
  }
}
