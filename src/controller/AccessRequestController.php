<?php

class AccessRequestController extends Controller
{
  public function index(): array
  {
    $sellerId = parameters()['userId'];
    $stateId = 0;

    $auctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
    $auctionAccessStateList = $auctionAccessStateBo->selectAllAuctionAccessStateBySellerIdAndStateId($sellerId, $stateId);

    $data = [
      'auctionAccessStateList' => $auctionAccessStateList
    ];

    return ['render', 'index', $data];
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
    $userId = parameters()['userId'];
    $auctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
    $auctionAccessStateBo->updateStateIdByAuctionAccessStateId($aasid, $stateId);

    return ['redirect', '?r=accessRequest&userId=' . $userId];
  }
}
