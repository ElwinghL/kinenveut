<?php

class AuctionController extends Controller
{
  /*----Views-----*/

  /*Return a page to create an auction*/
  public function create(): array
  {
    return ['render', 'create', $this->createDataForm()];
  }

  /*Return page with auctions created by one user*/
  public function sells(): array
  {
    $sellerId = parameters()['userId'];
    $userId = $_SESSION['userId'];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionList = $auctionBo->selectAllAuctionsBySellerId($sellerId);

    $titlePage = (($sellerId == $userId) ? 'Mes' : 'Ses') . ' ventes';
    $data = ['titlePage'   => $titlePage];

    if (is_array($auctionList) && sizeof($auctionList) > 0) {
      $data2 = ['auctionList' => $auctionList];
      $data = array_merge($data, $data2);

      //Todo: créer une vue différente !
      return ['render', 'index', $data];
    } else {
      //Todo : Gérer le cas où il y a 0 enchère :)
      return ['render', 'index', $data];
    }
  }

  /*Return page with auctions for which ones the user participated*/
  public function bids(): array
  {
    $bidderId = parameters()['userId'];
    $userId = $_SESSION['userId'];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionList = $auctionBo->selectAllAuctionsByBidderId($bidderId);

    if ($bidderId == $userId) {
      if (is_array($auctionList) && sizeof($auctionList) > 0) {
        $titlePage = 'Mes enchères';
        $data = [
          'titlePage'   => $titlePage,
          'auctionList' => $auctionList
        ];

        //Todo: créer une vue différente !
        return ['render', 'index', $this->createDataForm($data)];
      } else {
        //Todo : Gérer le cas où il y a 0 enchère :)
        return ['redirect', '?r=home'];
      }
    } else {
      //Todo : Gérer le cas où l'accès est interdit
      return ['redirect', '?r=home'];
    }
  }

  /*-----Actions-----*/

  public function abort(): array
  {
    $this->updateAuctionState(3);

    return ['redirect', '?r=auction/sells', ['userId' => $_SESSION['userId']]];
  }

  public function cancel(): array
  {
    $this->updateAuctionState(2);

    return ['redirect', '?r=auction/sells', ['userId' => $_SESSION['userId']]];
  }

  /*Create a new auction*/
  public function saveObjectAuction(): array
  {
    $errors = [];
    $values['name'] = filter_var(parameters()['name']);
    $values['description'] = filter_var(parameters()['description']);
    $values['basePrice'] = filter_var(parameters()['basePrice'], FILTER_VALIDATE_INT);
    $values['reservePrice'] = filter_var(parameters()['reservePrice'], FILTER_VALIDATE_INT);
    $values['duration'] = filter_var(parameters()['duration'], FILTER_VALIDATE_INT);
    $values['privacyId'] = filter_var(parameters()['privacyId'], FILTER_VALIDATE_INT);
    $values['categoryId'] = filter_var(parameters()['categoryId'], FILTER_VALIDATE_INT);

    if ($values['basePrice'] > $values['reservePrice']) {
      $errors['basePrice'] = 'Le prix de départ ne peut pas être supérieur au prix de réserve';
    }

    $data = ['errors' => $errors, 'values' => $values];

    if (!empty($data['errors'])) {
      return ['render', 'create', $this->createDataForm($data)];
    } else {
      $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
      $auction = new AuctionModel();

      $auction->setName($data['values']['name'])
        ->setDescription($data['values']['description'])
        ->setBasePrice($data['values']['basePrice'])
        ->setReservePrice($data['values']['reservePrice'])
        ->setDuration($data['values']['duration'])
        ->setSellerId($_SESSION['userId'])
        ->setPrivacyId($data['values']['privacyId'])
        ->setCategoryId($data['values']['categoryId']);

      $auctionId = $auctionBo->insertAuction($auction);

      if ($auctionId !== null) {
        //Todo: créer un message de succès
        return ['redirect', '?r=home'];
      } else {
        return ['render', 'create', $this->createDataForm($data)];
      }
    }
  }

  /*-----Private functions-----*/

  /*Create datas list for the form*/
  private function createDataForm($otherDatas = []): array
  {
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryList = $categoryBo->selectAllCategories();

    $data = [
      'categoryList' => $categoryList
    ];

    $data = array_merge($data, $otherDatas);

    return $data;
  }

  /*Upadte the auction state*/
  private function updateAuctionState(int $auctionState) : bool
  {
    $auctionId = parameters()['auctionId'];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auction = $auctionBo->selectAuctionByAuctionId($auctionId);

    if ($_SESSION['userId'] == $auction->getSellerId()) {
      $auction->setAuctionState($auctionState);
      $isUpdated = $auctionBo->updateAuctionState($auction);
    }

    return $isUpdated;
  }
}
