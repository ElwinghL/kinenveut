<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc63Context implements Context
{
  /**
   * @When l'utilisateur valide son enchère avec les champs invalides
   */
  public function lutilisateurValideSonEnchereAvecLesChampsInvalides()
  {
    $session = Universe::getUniverse()->getSession();
    $session->getPage()->find(
      'css',
      'input[name="name"]'
    )->setValue('Chaussette invalide');
    $session->getPage()->find(
      'css',
      'input[name="basePrice"]'
    )->setValue(2);
    $session->getPage()->find(
      'css',
      'input[name="createAuction"]'
    )->click();
  }

  /**
   * @Then l'enchère n'est pas créée
   */
  public function lenchereNestPasCreee()
  {
    checkUrl('http://localhost/kinenveut/?r=auction/saveObjectAuction');
    Universe::getUniverse()->setToDelete(['users' => [Universe::getUniverse()->getUser()]]);
  }
}
