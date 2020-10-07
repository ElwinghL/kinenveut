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
        'auction' => $auction,
        'seller'  => $seller
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
      if (!isset($_POST['bidPrice']) || $_POST['bidPrice'] === '') {
        $_SESSION['errors']['noBidPrice'] = 'Veuillez renseigner un montant à enchérir';
        $this->redirect('?r=bid/index&auctionId=' . $auctionId);
        exit();
      }

      $newBid = new BidModel();
      $newBid
                ->setBidPrice($_POST['bidPrice'])
                ->setBidderId($_SESSION['userId'])
                ->setObjectId($auctionId);

      $bidHistoryBo = App_BoFactory::getFactory()->getBidHistoryBo();
      $bidHistoryBo->insertBid($newBid);
    }

    $this->redirect('?r=bid&auctionId=' . $auctionId);
  }

  public function makeAuctionAccessRequest()
  {
    $bidderId = $_SESSION['userId'];
    $auctionId = $_GET['auctionId'];

    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    try {
      $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);
    } catch (BDDException $e) {
    }

    $this->redirect('?r=bid&auctionId=' . $auctionId);
  }

  public function cancelAuctionAccessRequest()
  {
    $bidderId = $_SESSION['userId'];
    $auctionId = $_GET['auctionId'];

    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    try {
      $auctionAccessStateDao->updateAuctionAccessStateByAuctionIdAndBidderId($auctionId, $bidderId);
    } catch (BDDException $e) {
    }
    $this->redirect('?r=bid&auctionId=' . $auctionId);
  }
}
