<?php

class AccessRequestController extends Controller
{
  /*Return */
  public function index()
  {
    $sellerId = $_SESSION['userId'];
    $stateId = 0;

    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    try {
      $auctionAccessStateList = $auctionAccessStateDao->selectAllAuctionAccessStateBySellerIdAndStateId($sellerId, $stateId);

      $data = [
        'auctionAccessStateList' => $auctionAccessStateList
      ];

      $this->render('index', $data);
    } catch (BDDException $e) {
      $this->redirect('?r=home');
    }
  }

  public function accept()
  {
    $this->updateRequestStateId(1);
  }

  public function refuse()
  {
    $this->updateRequestStateId(5);
  }

  private function updateRequestStateId($stateId)
  {
    $aasid = $_GET['aasid'];
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    try {
      $auctionAccessStateDao->updateStateIdByAuctionAccessStateId($aasid, $stateId);
    } catch (BDDException $e) {
      $this->redirect('?r=home');
    }
    $this->redirect('?r=accessRequest');
  }
}
