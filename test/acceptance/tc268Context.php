<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc268Context implements Context
{
  /**
   * @Given l'utilisateur consulte les propositions d'enchères
   */
  public function lutilisateurConsulteLesPropositionsDencheres()
  {
    throw new PendingException();
  }

  /**
   * @Given la liste des propositions d'enchères n'est pas vide
   */
  public function laListeDesPropositionsDencheresNestPasVide()
  {
    throw new PendingException();
  }

  /**
   * @When l'admin valide une proposition d'enchère
   */
  public function ladminValideUnePropositionDenchere()
  {
    throw new PendingException();
  }

  /**
   * @Then la proposition d'enchère n'est plus à valider
   */
  public function laPropositionDenchereNestPlusAValider()
  {
    throw new PendingException();
  }

  /**
   * @Then la proposition d'enchère est accessible aux utilisateurs du site
   */
  public function laPropositionDenchereEstAccessibleAuxUtilisateursDuSite()
  {
    throw new PendingException();
  }

  /**
   * @When l'admin refuse une proposition d'enchère
   */
  public function ladminRefuseUnePropositionDenchere()
  {
    throw new PendingException();
  }

  /**
   * @Then la proposition d'enchère n'est pas accessible aux utilisateurs du site
   */
  public function laPropositionDenchereNestPasAccessibleAuxUtilisateursDuSite()
  {
    throw new PendingException();
  }
}
