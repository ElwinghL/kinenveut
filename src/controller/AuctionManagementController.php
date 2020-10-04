<?php

class AuctionManagementController extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);
    $data = [
      'auctions'=> $auctions
    ];
    $this->render('index', $data);
  }
}
