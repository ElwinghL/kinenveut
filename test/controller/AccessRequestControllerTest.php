<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class AccessRequestControllerTest extends TestCase
{
  /**
   * @test
   * @covers AccessRequestController
   */
  public function indexTest()
  {
    setParameters(['userId'=>42]);

    $auction = new AuctionModel();
    $auction
      ->setId(0)
      ->setName('Ma belle Auction')
      ->setDescription('Vend un OBJECT pour cause de PAS UTILISE')
      ->setBasePrice(0)
      ->setReservePrice(100)
      ->setPictureLink('www.perdu.com')
      ->setStartDate(new DateTime())
      ->setDuration(14)
      ->setAuctionState(null)
      ->setSellerId(0)
      ->setPrivacyId(0)
      ->setCategoryId(0);

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImpl::class, ['selectAllAuctionAccessStateBySellerIdAndStateId']);
    $auctionAccessStateBoMock->method('selectAllAuctionAccessStateBySellerIdAndStateId')->willReturn([$auction]);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionAccessStateBo']);
    $app_BoFactoryMock->method('getAuctionAccessStateBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $accessController = new AccessRequestController();
    $data = $accessController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(['auctionAccessStateList'=>[$auction]], $data[2]);
  }

  /**
   * @test
   * @covers AccessRequestController
   */
  public function acceptTest()
  {
    $accessController = new AccessRequestController();

    global $parameters;
    $parameters = ['aasid'=>42];

    $auction = new AuctionModel();
    $id = 0;
    $name = 'Ma belle Auction';
    $description = 'Vend un OBJECT pour cause de PAS UTILISE';
    $basePrice = 0;
    $reservePrice = 100;
    $pictureLink = 'www.perdu.com';
    $startDate = new DateTime();
    $duration = 14;
    $auctionState = null; //(null: attente d'acceptation, 0: EnchèreEnCours, 1: Annulée)
    $sellerId = 0;
    $privacyId = 0;
    $categoryId = 0;

    $auction
          ->setId($id)
          ->setName($name)
          ->setDescription($description)
          ->setBasePrice($basePrice)
          ->setReservePrice($reservePrice)
          ->setPictureLink($pictureLink)
          ->setStartDate($startDate)
          ->setDuration($duration)
          ->setAuctionState($auctionState)
          ->setSellerId($sellerId)
          ->setPrivacyId($privacyId)
          ->setCategoryId($categoryId);

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImpl::class, ['updateStateIdByAuctionAccessStateId']);
    $auctionAccessStateBoMock->method('updateStateIdByAuctionAccessStateId')->will($this->onConsecutiveCalls(true));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionAccessStateBo']);
    $app_BoFactoryMock->method('getAuctionAccessStateBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accessController->accept();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=accessRequest', $data[1]);
  }

  /**
   * @test
   * @covers AccessRequestController
   */
  public function refuseTest()
  {
    $accessController = new AccessRequestController();

    global $parameters;
    $parameters = ['aasid'=>42];

    $auction = new AuctionModel();
    $id = 0;
    $name = 'Ma belle Auction';
    $description = 'Vend un OBJECT pour cause de PAS UTILISE';
    $basePrice = 0;
    $reservePrice = 100;
    $pictureLink = 'www.perdu.com';
    $startDate = new DateTime();
    $duration = 14;
    $auctionState = null; //(null: attente d'acceptation, 0: EnchèreEnCours, 1: Annulée)
    $sellerId = 0;
    $privacyId = 0;
    $categoryId = 0;

    $auction
          ->setId($id)
          ->setName($name)
          ->setDescription($description)
          ->setBasePrice($basePrice)
          ->setReservePrice($reservePrice)
          ->setPictureLink($pictureLink)
          ->setStartDate($startDate)
          ->setDuration($duration)
          ->setAuctionState($auctionState)
          ->setSellerId($sellerId)
          ->setPrivacyId($privacyId)
          ->setCategoryId($categoryId);

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImpl::class, ['updateStateIdByAuctionAccessStateId']);
    $auctionAccessStateBoMock->method('updateStateIdByAuctionAccessStateId')->will($this->onConsecutiveCalls(true));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionAccessStateBo']);
    $app_BoFactoryMock->method('getAuctionAccessStateBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accessController->refuse();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=accessRequest', $data[1]);
  }
}
