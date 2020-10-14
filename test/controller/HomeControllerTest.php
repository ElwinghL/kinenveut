<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class HomeControllerTest extends TestCase
{
  /**
   * @test
   * @covers HomeController
   */
  public function indexTest()
  {
    $homeController = new HomeController();
    $auctionList = ['a'];
    $confidentialAuctionList = ['b'];
    $categoryList = ['c'];
    $_SESSION['userId'] = 1;

    $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAllAuctionsByAuctionState', 'selectAcceptedConfidentialAuctionsByBidderId']);
    $auctionBoMock->method('selectAllAuctionsByAuctionState')->willReturn($auctionList);
    $auctionBoMock->method('selectAcceptedConfidentialAuctionsByBidderId')->willReturn($confidentialAuctionList);

    $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
    $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo', 'getCategoryBo']);
    $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
    $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $homeController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame([
      'categoryList' => $categoryList,
      'auctionList'  => array_merge($auctionList, $confidentialAuctionList)
    ], $data[2]);

    unset($_SESSION['userId']);
  }

  /**
   * @test
   * @covers HomeController
   */
  public function searchTest()
  {
    $homeController = new HomeController();

    $auction = new AuctionModel();
    $auction->setName('Maillot de bain');
    $auction->setPrivacyId(1);
    $auction->setCategoryId(1);

    $auction2 = new AuctionModel();
    $auction2->setName('Renault Express');
    $auction2->setPrivacyId(2);
    $auction2->setCategoryId(2);

    $auctionList = [$auction, $auction2];
    $confidentialAuctionList = [];
    $categoryList = ['c'];

    $categoryType = '1';
    $offerType = '1';
    $searchInput = 'Maillot de bain';
    setParameters(['categoryType' => $categoryType, 'offerType' => $offerType, 'searchInput' => $searchInput]);
    $_SESSION['userId'] = 1;

    $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAllAuctionsByAuctionState', 'selectAcceptedConfidentialAuctionsByBidderId']);
    $auctionBoMock->method('selectAllAuctionsByAuctionState')->willReturn($auctionList);
    $auctionBoMock->method('selectAcceptedConfidentialAuctionsByBidderId')->willReturn($confidentialAuctionList);

    $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
    $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo', 'getCategoryBo']);
    $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
    $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $homeController->search();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame([
      'categoryList'      => $categoryList,
      'auctionList'       => [$auction],
      'selectedCategory'  => $categoryType,
      'selectedOfferType' => $offerType,
      'searchInput'       => $searchInput
    ], $data[2]);

    unset($_SESSION['userId']);
  }
}
