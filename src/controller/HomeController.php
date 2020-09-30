<?php

class HomeController extends Controller
{
  protected const IS_ONLINE = 1;

  public function index()
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionList = $auctionBo->selectAllAuctionsByAuctionState(self::IS_ONLINE);
    $data = ['auctionList' => $auctionList];

    $this->render('index', $data);
  }
}
