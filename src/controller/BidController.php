<?php

class BidController extends Controller
{
  public function index()
  {
    $auctionId = $_GET['auctionId'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->addBid($auctionId);
    }

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);

    $data = [
      'auction'=> $auction
    ];

    $this->render('index', $data);
  }

  private function addBid($auctionId) : int
  {
    $_POST['bidPrice'];

    $newBid = new BidModel();
    $newBid
            ->setBidPrice($_POST['bidPrice'])
            ->setBidderId(1) //todo : get user id (bidderId)
            ->setObjectId($auctionId);

    $bidHistoryBo = App_BoFactory::getFactory()->getBidHistoryBo();
    $bidId = $bidHistoryBo->insertBid($newBid);

    return $bidId;
  }
}
