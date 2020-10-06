<?php

class AuctionManagementController extends Controller
{
  public function index()
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);
    $data = [
      'auctions'=> $auctions
    ];
    $this->render('index', $data);
  }
  public function info()
  {
    $auctionId = $_GET['id'];
    
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);

    $userBo = App_BoFactory::getFactory()->getUserBo();    
    $seller = $userBo->selectUserByUserId($auction->getSellerId());

    $data = [
      'auction'=> $auction,
      'seller' => $seller
    ];
    $bidcontroller=new BidController();
    $bidcontroller->render('index', $data);
  }
  public function validate()
  { $auctionId = $_GET['id'];
    
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);
    $auction->setAuctionState(1);//Etat Accepté
    $auctionBo->updateStartDateAndAuctionState($auction);
    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);
    $data = [
      'auctions'=> $auctions
    ];
    $this->render('index', $data);
  }
  public function delete()
  {
    $auctionId = $_GET['id'];
    
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);
    $auction->setAuctionState(2);//Etat Refusé
    $auctionBo->updateStartDateAndAuctionState($auction);
    
    $auctions = $auctionBo->selectAllAuctionsByAuctionState(0);
    $data = [
      'auctions'=> $auctions
    ];
    $this->render('index', $data);
  }
}
