<?php

class AuctionController extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    $this->render('index');
  }

  public function myAuction()
  {
    $this->render('myAuction');
  }

  public function alerte()
  {
    $this->render('alerte');
  }

  public function create()
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = new AuctionModel();

    $auction
            ->setName($_POST['name'])
            ->setBasePrice($_POST['basePrice'])
            ->setReservePrice($_POST['reservePrice'])
            ->setStartDate($_POST['startDate'])
            ->setEndDate($_POST['endDate'])
            ->setPrivacyId($_POST['privacyId'])
            ->setCategoryId($_POST['categoryId']);
    $success = $auctionBo->insertAuction($auction);

    if ($success == true) {
      $loginController = new LoginController();
      $loginController->index();
    } else {
      $this->render('index', $_POST);
    }
  }
}
