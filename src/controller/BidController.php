<?php

class BidController extends Controller
{
  public function index()
  {
    $auctionId = $_GET['auctionId'];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);

    if ($auction != null && $auction->getSellerId() > 0) {
      $userBo = App_BoFactory::getFactory()->getUserBo();
      $seller = $userBo->selectUserByUserId($auction->getSellerId());

      $data = [
        'auction'=> $auction,
        'seller' => $seller
      ];

      $this->render('index', $data);
    } else {
      //Todo : redirection page erreur
      $this->redirect('?r=home');
    }
  }

  public function addBid()
  {
    $auctionId = $_GET['auctionId'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $newBid = new BidModel();
      $newBid
              ->setBidPrice($_POST['bidPrice'])
              ->setBidderId($_SESSION['userId'])
              ->setObjectId($auctionId);

      $bidHistoryBo = App_BoFactory::getFactory()->getBidHistoryBo();
      $bidHistoryBo->insertBid($newBid);
    }

    $this->redirect("?r=bid&auctionId=" . $_GET['auctionId']);
  }
}
