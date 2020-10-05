<?php

class AuctionController extends Controller
{
  public function check()
  {
    $errors = [];
    $values['name'] = filter_input(INPUT_POST, 'name');
    $values['description'] = filter_input(INPUT_POST, 'description');
    $values['basePrice'] = filter_input(INPUT_POST, 'basePrice', FILTER_VALIDATE_INT);
    $values['reservePrice'] = filter_input(INPUT_POST, 'reservePrice', FILTER_VALIDATE_INT);
    $values['startDate'] = filter_input(INPUT_POST, 'startDate');
    $values['duration'] = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);
    $values['privacyId'] = filter_input(INPUT_POST, 'privacyId', FILTER_VALIDATE_INT);
    $values['categoryId'] = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);

    if (!(preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $values['startDate'], $matches)
    && checkdate($matches[2], $matches[3], $matches[1])
    && DateTime::createFromFormat('d/m/Y', $values['startDate']) < (new DateTime()))) {
      $errors['startDate'] = 'La date n\'est pas valide';
    }

    if ($values['basePrice'] > $values['reservePrice']) {
      $errors['basePrice'] = 'Le prix de départ ne peut pas être supérieur au prix de réserve';
    }

    return ['errors'=> $errors, 'values' => $values];
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
    $data = $this->check();
    if (!empty($data['errors'])) {
      $this->render('create', $data);
    }

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = new AuctionModel();

    $auction->setName($data['values']['name'])
                ->setDescription($data['values']['description'])
                ->setBasePrice($data['values']['basePrice'])
                ->setReservePrice($data['values']['reservePrice'])
                ->setStartDate($data['values']['startDate'])
                ->setDuration($data['values']['duration'])
                ->setSellerId(0)//Todo : récupérer l'id de l'utilisateur
                ->setPrivacyId($data['values']['privacyId'])
                ->setCategoryId($data['values']['categoryId']);

    $auctionId = $auctionBo->insertAuction($auction);
    if ($auctionId !== null) {
      $this->render('index');
    }
  }
}
