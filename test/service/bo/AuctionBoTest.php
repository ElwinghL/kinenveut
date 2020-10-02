<?php

use PHPUnit\Framework\TestCase;

//include_once 'src/tools.php';

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
   * @covers
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
   * @covers
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
   * @covers
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
}
