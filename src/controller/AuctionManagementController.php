<?php

class AuctionManagementController extends Controller
{
  public function index(): array
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);
    $data = [
      'auctions' => $auctions
    ];

    return ['render', 'index', $data];
  }

  public function info(): array
  {
    $auctionId = $_GET['id'];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);

    $data = [
      'auction' => $auction
    ];

    return ['render', 'bid', $data];
  }

  public function validate(): array
  {
    $auctionId = $_GET['id'];
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);
    $auction->setAuctionState(1); //Etat Accepté
    $auctionBo->updateStartDateAndAuctionState($auction);
    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);
    $data = [
      'auctions' => $auctions
    ];

    return ['render', 'index', $data];
  }

  public function delete(): array
  {
    $auctionId = $_GET['id'];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);
    $auction->setAuctionState(2); //Etat Refusé
    $auctionBo->updateStartDateAndAuctionState($auction);

    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);
    $data = [
      'auctions' => $auctions
    ];

    return ['render', 'index', $data];
  }
}
