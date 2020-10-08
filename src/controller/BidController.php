<?php

class BidController extends Controller
{
  public function index(): array
  {
    $auctionId = parameters()['auctionId'];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);

    if ($auction != null && $auction->getSellerId() > 0) {
      $userBo = App_BoFactory::getFactory()->getUserBo();
      $seller = $userBo->selectUserByUserId($auction->getSellerId());

      $auctionAccessSateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
      $auctionAccessState = $auctionAccessSateBo->selectAuctionAccessStateByAuctionIdAndBidderId($auctionId, $_SESSION['userId']);

      $data = [
        'auction'            => $auction,
        'seller'             => $seller,
        'auctionAccessState' => $auctionAccessState
      ];

      return ['render', 'index', $data];
    } else {
      //Todo : redirection page erreur
      return ['redirect', '?r=home'];
    }
  }

  public function addBid(): array
  {
    $auctionId = parameters()['auctionId'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset(parameters()['bidPrice']) || parameters()['bidPrice'] === '') {
        $_SESSION['errors']['noBidPrice'] = 'Veuillez renseigner un montant à enchérir';

        return ['redirect', '?r=bid/index', ['auctionId' => $auctionId]];
      }

      $newBid = new BidModel();
      $newBid
        ->setBidPrice(parameters()['bidPrice'])
        ->setBidderId($_SESSION['userId'])
        ->setObjectId($auctionId);

      $bidHistoryBo = App_BoFactory::getFactory()->getBidHistoryBo();
      $bidHistoryBo->insertBid($newBid);
    }

    return ['redirect', '?r=bid', ['auctionId' => $auctionId]];
  }

  public function makeAuctionAccessRequest(): array
  {
    $bidderId = $_SESSION['userId'];
    $auctionId = parameters()['auctionId'];
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    try {
      $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);
    } catch (BDDException $e) {
      $auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, 0);
    }

    return ['redirect', '?r=bid', ['auctionId' => $auctionId]];
  }

  public function cancelAuctionAccessRequest(): array
  {
    $bidderId = $_SESSION['userId'];
    $auctionId = parameters()['auctionId'];

    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    try {
      $auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, 2);
    } catch (BDDException $e) {
    }

    return ['redirect', '?r=bid', ['auctionId' => $auctionId]];
  }
}
