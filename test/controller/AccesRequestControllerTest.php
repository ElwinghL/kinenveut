<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class AccesRequestControllerTest extends TestCase
{
  /**
   * @test
   * @covers AccesRequestController
   */
  public function indexTest()
  {
    setParameters(['userId'=>42]);
    $accessController = new AccessRequestController();

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

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImplBo::class, ['selectAllAuctionAccessStateBySellerIdAndStateId']);
    $auctionAccessStateBoMock->method('selectAllAuctionAccessStateBySellerIdAndStateId')->will($this->onConsecutiveCalls($auction));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionAccessStateBoImplBo']);
    $app_BoFactoryMock->method('getAuctionAccessStateBoImplBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accessController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
  }

  /**
   * @test
   * @covers AccesRequestController
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

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImplBo::class, ['updateStateIdByAuctionAccessStateId']);
    $auctionAccessStateBoMock->method('updateStateIdByAuctionAccessStateId')->will($this->onConsecutiveCalls($auction));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionAccessStateBoImplBo']);
    $app_BoFactoryMock->method('getAuctionAccessStateBoImplBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $accessController->accept();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=accessRequest', $data[1]);
  }

  /*  public function accept(): array
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
    $auctionAccessStateDao = App_BoFactory::getFactory()->getAuctionAccessStateBoImplBo();

    $auctionAccessStateDao->updateStateIdByAuctionAccessStateId($aasid, $stateId);


    return ['redirect', '?r=accessRequest'];
  }*/
}
