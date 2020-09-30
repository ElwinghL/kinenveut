<?php

class HomeController extends Controller
{
  public function index()
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $dataTmp['auctions'] = $auctionBo->selectAllAuctions();
    $this->render('index', $dataTmp);
  }
}
