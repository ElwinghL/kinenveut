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
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryList = $categoryBo->selectAllCategories();

    $data = [
      'categoryList' => $categoryList
    ];

    $this->render('create', $data);
  }

  public function saveObjectAuction()
  {
    $name = trim($_POST['name']);
    $noTags = strip_tags($name);

    if ($name != $noTags) {
      $errors['name'] = 'La zone Objet ne peut pas contenir de code HTML';
    }
    $description = trim($_POST['description']);
    $noTags = strip_tags($description);
    if ($description != $noTags) {
      $errors['description'] = 'La zone Description ne peut pas contenir de code HTML';
    }

    $basePrice = $_POST['basePrice'];
    $reservePrice = $_POST['reservePrice'];

    if ($basePrice > $reservePrice) {
      $errors['basePrice'] = 'Le prix de départ ne peut pas être supérieur au prix de réserve';
    }

    if (!isset($errors)) {
      $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
      $auction = new AuctionModel();

      $auction->setName($_POST['name'])
                ->setDescription($_POST['name'])
                ->setBasePrice($_POST['basePrice'])
                ->setReservePrice($_POST['reservePrice'])
                ->setStartDate($_POST['startDate'])
                ->setDuration($_POST['duration'])
                ->setSellerId(0)//Todo : récupérer l'id de l'utilisateur
                ->setPrivacyId($_POST['privacyId'])
                ->setCategoryId($_POST['categoryId']);

      $auctionId = $auctionBo->insertAuction($auction);
      if ($auctionId !== null) {
        $this->render('index');
      } else {
        $errors['dbError'] = "Une erreur s'est produite avec la base de données";
        $dataTmp = $_POST;
        $dataTmp['errors'] = $errors;
        $_SESSION['auctionData'] = $dataTmp;
        $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
        $categoryList = $categoryBo->selectAllCategories();
        $data = [
          'categoryList' => $categoryList
        ];
        $this->render('create', $data);
      }
    } else {
      $dataTmp = $_POST;
      $dataTmp['errors'] = $errors;
      $_SESSION['auctionData'] = $dataTmp;
      $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
      $categoryList = $categoryBo->selectAllCategories();
      $data = [
        'categoryList' => $categoryList
      ];
      $this->render('create', $data);
    }
  }
}
