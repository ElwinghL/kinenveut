<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class AuctionBoTest extends TestCase
{
  /** @before*/
  protected function setUp() : void
  {
    parent::setUp();
    App_BoFactory::setFactory(new App_BoFactory());
  }

  /**
   * @test
   * @covers AuctionBoImpl
   */
  public function insertAuctionTest() : void
  {
    $expectedAuctionId = 42;
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionMock = $this->createPartialMock(AuctionModel::class, []);
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['insertAuction']);
    $auctionDaoImpMock->method('insertAuction')->willReturn($expectedAuctionId);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $auctionId = $auctionBo->insertAuction($auctionMock);

    $this->assertSame($expectedAuctionId, $auctionId);
  }

  /**
   * @test
   * @covers AuctionBoImpl
   */
  public function updateStartDateAndAuctionStateTest(): void
  {
    $expectedState = true;
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionMock = $this->createPartialMock(AuctionModel::class, []);
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['updateStartDateAndAuctionState']);
    $auctionDaoImpMock->method('updateStartDateAndAuctionState')->willReturn($expectedState);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $isUpdated = $auctionBo->updateStartDateAndAuctionState($auctionMock);

    $this->assertSame($expectedState, $isUpdated);
  }

  /**
   * @test
   * @covers AuctionBoImpl
   */
  public function updateAuctionStateTest(): void
  {
    $expectedState = true;
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionMock = $this->createPartialMock(AuctionModel::class, []);
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['updateAuctionState']);
    $auctionDaoImpMock->method('updateAuctionState')->willReturn($expectedState);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $isUpdated = $auctionBo->updateAuctionState($auctionMock);

    $this->assertSame($expectedState, $isUpdated);
  }

  /**
   * @test
   * @covers AuctionBoImpl
   */
  public function deleteAuctionTest() : void
  {
    $expectedSuccess = true;
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['deleteAuctionById']);
    $auctionDaoImpMock->method('deleteAuctionById')->willReturn($expectedSuccess);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $success = $auctionBo->deleteAuctionById(42);

    $this->assertSame($expectedSuccess, $success);
  }

  /**
   * @test
   * @covers AuctionBoImpl
   */
  public function selectAllAuctionsByAuctionStateTest() : void
  {
    $auctionState = 1;

    $expectedAuction = new AuctionModel();
    $expectedAuction
            ->setId(42)
            ->setName('Object Test')
            ->setBasePrice(3)
            ->setReservePrice(10)
            //->setCreationDate(creationDate)
            ->setStartDate('2020-01-01')
            ->setDuration(7)
            ->setAuctionState($auctionState)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $expectedAuctionList = [$expectedAuction];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['selectAllAuctionsByAuctionState']);
    $auctionDaoImpMock->method('selectAllAuctionsByAuctionState')->willReturn($expectedAuctionList);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $auctionList = $auctionBo->selectAllAuctionsByAuctionState(1);

    $this->assertSame($expectedAuctionList, $auctionList);
  }

  /**
   * @test
   * @covers AuctionBoImpl
   */
  public function selectAllAuctionsBySellerIdTest() : void
  {
    $sellerId = 7;

    $expectedAuction = new AuctionModel();
    $expectedAuction
            ->setId(42)
            ->setName('Object Test')
            ->setBasePrice(3)
            ->setReservePrice(10)
            //->setCreationDate(creationDate)
            ->setStartDate('2020-01-01')
            ->setDuration(7)
            ->setAuctionState(1)
            ->setSellerId($sellerId)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $expectedAuctionList = [$expectedAuction];

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['selectAllAuctionsBySellerId']);
    $auctionDaoImpMock->method('selectAllAuctionsBySellerId')->willReturn($expectedAuctionList);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $auctionList = $auctionBo->selectAllAuctionsBySellerId(7);

    $this->assertSame($expectedAuctionList, $auctionList);
  }

  /**
   * @test
   * @covers AuctionBoImpl
   */
  public function selectAuctionByAuctionIdTest() : void
  {
    $id = 42;
    $expectedAuction = new AuctionModel();
    $expectedAuction
            ->setId($id)
            ->setName('Object Test')
            ->setBasePrice(3)
            ->setReservePrice(10)
            //->setCreationDate(creationDate)
            ->setStartDate('2020-01-01')
            ->setDuration(7)
            ->setAuctionState(0)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['selectAuctionByAuctionId']);
    $auctionDaoImpMock->method('selectAuctionByAuctionId')->willReturn($expectedAuction);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $auctionSelected = $auctionBo->selectAuctionByAuctionId($id);

    $this->assertSame($expectedAuction, $auctionSelected);
  }

  /**
   * @test
   * @covers AuctionBoImpl
   */
  public function getBestBidFrom_selectAuctionByAuctionIdTest(): void
  {
    $auctionId = 42;

    /*First step : create an auction*/
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();

    $auctionTest = new AuctionModel();
    $auctionTest
          ->setId($auctionId)
          ->setName('Object Test')
          ->setDescription('descr')
          ->setBasePrice(3)
          ->setReservePrice(10)
          //->setCreationDate(creationDate)
          ->setStartDate('2020-01-01')
          ->setDuration(7)
          ->setSellerId(1)
          ->setPrivacyId(0)
          ->setCategoryId(1);

    /*Second step : create a bid*/
    $bidTest = new BidModel();
    $bidTest
      ->setBidPrice(42)
      ->setBidDate('2020-10-01')
      ->setBidderId(1)
      ->setObjectId($auctionId);

    /*Third step : Create the Expected auction*/
    $expectedAuction = $auctionTest->setBestBid($bidTest);

    /*Fourth step : Create Mocks*/
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['selectAuctionByAuctionId']);
    $auctionDaoImpMock->method('selectAuctionByAuctionId')->willReturn($expectedAuction);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);

    App_DaoFactory::setFactory($app_DaoFactoryMock);

    /*Fifth step : select an auction with the best bid**/
    $auctionSelected = $auctionBo->selectAuctionByAuctionId($auctionId);

    /*Last step : test the result*/
    $this->assertSame($expectedAuction, $auctionSelected);
  }
}
