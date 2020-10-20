<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class tc267Context implements Context
{
  /**
   * @Given L'utilisateur est sur la page de mise à jour de profile
   */
  public function lutilisateurEstSurLaPageDeMiseAJourDeProfile()
  {
    $session = Universe::getUniverse()->getSession();
    visitOwnAccountPage($session);

    $url = '/?r=account&userId=' . Universe::getUniverse()->getUser()->getId();
    checkUrl($url);
  }

  /**
   * @Given L'utilisateur a entré la valeur :arg1 dans le champ :arg2
   */
  public function lutilisateurAEntreLaValeurDansLeChamp($arg1, $arg2)
  {
    throw new PendingException();
  }

  /**
   * @Then Le champ :arg1 du profile contient la valeur :arg2
   */
  public function leChampDuProfileContientLaValeur($arg1, $arg2)
  {
    throw new PendingException();
  }
}
