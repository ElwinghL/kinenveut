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

      $auctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
      $auctionAccessState = $auctionAccessStateBo->selectAuctionAccessStateByAuctionIdAndBidderId($auctionId, $_SESSION['userId']);

      $data = [
        'return' => '?home',
        'auction'            => $auction,
        'seller'             => $seller,
        'auctionAccessState' => $auctionAccessState
      ];

        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true && isset($_SERVER['HTTP_REFERER'])){
            $data['return'] =  $_SERVER['HTTP_REFERER'];
        }
      return ['render', 'index', $data];
    } else {
      //Todo : redirection page erreur
      return ['redirect', '?r=home'];
    }
  }

  public function addBid(): array
  {
    $auctionId = parameters()['auctionId'];

    $data = ['auctionId' => $auctionId];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset(parameters()['bidPrice']) || parameters()['bidPrice'] === '') {
        $_SESSION['errors']['noBidPrice'] = 'Veuillez renseigner un montant à enchérir';

        return ['redirect', '?r=bid', $data];
      }

      $newBid = new BidModel();
      $newBid
        ->setBidPrice(parameters()['bidPrice'])
        ->setBidderId($_SESSION['userId'])
        ->setObjectId($auctionId);

      $bidHistoryBo = App_BoFactory::getFactory()->getBidHistoryBo();
      $bidHistoryBo->insertBid($newBid);
    }

    return ['redirect', '?r=bid', $data];
  }

  public function makeAuctionAccessRequest(): array
  {
    $bidderId = $_SESSION['userId'];
    $auctionId = parameters()['auctionId'];

    $auctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();

    try {
      $auctionAccessStateBo->insertAuctionAccessState($auctionId, $bidderId);
    } catch (BDDException $e) {
        $auctionAccessStateBo->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, 0);
    }

    return ['redirect', '?r=bid', ['auctionId' => $auctionId]];
  }

  public function cancelAuctionAccessRequest(): array
  {
    $bidderId = $_SESSION['userId'];
    $auctionId = parameters()['auctionId'];

    $auctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();

    try {
      $auctionAccessStateBo->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, 2);
    } catch (BDDException $e) {
    }

    return ['redirect', '?r=bid', ['auctionId' => $auctionId]];
  }
}
