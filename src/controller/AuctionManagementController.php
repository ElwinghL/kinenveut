<?php

class AuctionManagementController extends Controller
{
  /*-----Views-----*/

  /*Return an admin page of Auction list to accept or refuse*/
  public function index(): array
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);
    $data = [
      'auctions' => $auctions
    ];

    return ['render', 'index', $data];
  }

  /*-----Actions-----*/

  public function validate(): array
  {
    $auctionId = parameters()['id'];

    return $this->updateAuction($auctionId, 1); //Etat Accepté
  }

  public function delete(): array
  {
    $auctionId = parameters()['id'];

    return $this->updateAuction($auctionId, 2);//Etat Refusé
  }

  /*----Private functions----*/

  private function updateAuction($auctionId, $auctionState): array
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);
    $auction->setAuctionState($auctionState);

    $auctionBo->updateStartDateAndAuctionState($auction);
    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);

    $data = [
      'auctions' => $auctions
    ];

    return ['render', 'index', $data];
  }
}
