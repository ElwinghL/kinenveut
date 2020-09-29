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
    $this->render('create');
  }

  public function saveObjectAuction()
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = new AuctionModel();

    $auction->setName($_POST['name'])
          ->setBasePrice($_POST['basePrice'])
          ->setReservePrice($_POST['reservePrice'])
          //->setCreationDate($_POST['creationDate'])
          ->setStartDate($_POST['startDate'])
          ->setDuration($_POST['duration'])
          ->setSellerId(0)//Todo : récupérer l'id de l'utilisateur
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
