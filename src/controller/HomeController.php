<?php

class HomeController extends Controller
{
  protected const IS_ONLINE = 1;

  public function index(): array
  {
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionList = $auctionBo->selectAllAuctionsByAuctionState(self::IS_ONLINE);

    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryList = $categoryBo->selectAllCategories();

    $data = [
      'categoryList' => $categoryList,
      'auctionList'  => $auctionList
    ];

    return ['render', 'index', $data];
  }

  public function search(): array
  {
    $categoryType = parameters()['categoryType'];
    $offerType = parameters()['offerType'];
    $searchInput = protectStringToDisplay(parameters()['searchInput']);

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionList = $auctionBo->selectAllAuctionsByAuctionState(self::IS_ONLINE);

    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryList = $categoryBo->selectAllCategories();

    $filteredAuctionList = [];
    foreach ($auctionList as $auction) {
      if (($categoryType == -1 || $auction->getCategoryId() == $categoryType) &&
        ($offerType == -1 || $auction->getPrivacyId() == $offerType) &&
        ($searchInput == '' || strpos($auction->getName(), $searchInput) !== false)
      ) {
        $filteredAuctionList[] = $auction;
      }
    }

    $data = [
      'categoryList'      => $categoryList,
      'auctionList'       => $filteredAuctionList,
      'selectedCategory'  => $categoryType,
      'selectedOfferType' => $offerType,
      'searchInput'       => $searchInput
    ];

    return ['render', 'index', $data];
  }
}
