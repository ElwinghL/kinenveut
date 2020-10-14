<?php

class AccessRequestController extends Controller
{
  public function index(): array
  {
    $sellerId = $_SESSION['userId'];
    $stateId = 0;

    $auctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
    try {
      $auctionAccessStateList = $auctionAccessStateBo->selectAllAuctionAccessStateBySellerIdAndStateId($sellerId, $stateId);

      $data = [
        'auctionAccessStateList' => $auctionAccessStateList
      ];

      return ['render', 'index', $data];
    } catch (BDDException $e) {
      return ['redirect', '?r=home'];
    }
  }

  public function accept(): array
  {
    return $this->updateRequestStateId(1);
  }

  public function refuse(): array
  {
    return $this->updateRequestStateId(5);
  }

  private function updateRequestStateId($stateId): array
  {
    $aasid = parameters()['aasid'];
    $auctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
    try {
      $auctionAccessStateBo->updateStateIdByAuctionAccessStateId($aasid, $stateId);
    } catch (BDDException $e) {
      return ['redirect', '?r=home'];
    }

    return ['redirect', '?r=accessRequest'];
  }
}
