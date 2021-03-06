<?php

use Behat\Behat\Context\Context;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

/**
 * Defines application features from the specific context.
 */
class defaultContext implements Context
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
    Universe::getUniverse()->getSession()->restart();
  }

  public function __destruct()
  {
    $this->deleteUsersUniverse();
    Universe::getUniverse()->setUser(null);
    Universe::getUniverse()->setUser2(null);
    Universe::getUniverse()->setUser3(null);
    Universe::getUniverse()->setAuction(null);
  }

  private function deleteUsersUniverse()
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $userBo = App_BoFactory::getFactory()->getUserBo();
    $auction = Universe::getUniverse()->getAuction();

    $users = [Universe::getUniverse()->getUser(), Universe::getUniverse()->getUser2(), Universe::getUniverse()->getUser3()];
    foreach ($users as $user) {
      if ($user != null) {
        $user = $userBo->selectUserByEmail($user->getEmail());
        if ($user != null && !$user->getIsAdmin()) {
          if ($auction != null) {
            $userAuctions = $auctionBo->selectAllAuctionsBySellerId($user->getId());
            foreach ($userAuctions as $oneAuction) {
              if ($auction->getName() == $oneAuction->getName()) {
                $auctionBo->deleteAuctionById($oneAuction->getId());
              }
            }
          }
          $userBo->deleteUser($user->getId());
        }
      }
    }
  }
}
