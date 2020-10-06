<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class AuctionAccessStateBoTest extends TestCase
{
  /** @before */
  public function setUp(): void
  {
    parent::setUp();
    App_BoFactory::setFactory(new App_BoFactory());
  }

  /**
   * @test
   * @covers AuctionAccessStateBoImpl
   */
  public function insertAuctionAccessStateTest(): void
  {
    $expectedAuctionAccessStateId = 42;

    $AuctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
    $AuctionAccessStateMock = $this->createPartialMock(AuctionAccessStateModel::class, []);
    $AuctionAccessStateDaoImpMock = $this->createPartialMock(AuctionAccessStateDaoImpl::class, ['insertAuctionAccessState']);
    $AuctionAccessStateDaoImpMock->method('insertAuctionAccessState')->willReturn($expectedAuctionAccessStateId);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionAccessStateDao']);
    $app_DaoFactoryMock->method('getAuctionAccessStateDao')->willReturn($AuctionAccessStateDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $AuctionAccessStateId = $AuctionAccessStateBo->insertAuctionAccessState($AuctionAccessStateMock);

    $this->assertSame($expectedAuctionAccessStateId, $AuctionAccessStateId);
  }

  /**
   * @test
   * @covers AuctionAccessStateBoImpl
   */
  public function updateAuctionAccessStateTest(): void
  {
    $expectedState = true;

    $auctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
    $auctionAccessStateDaoImpMock = $this->createPartialMock(AuctionAccessStateDaoImpl::class, ['updateStateId']);
    $auctionAccessStateDaoImpMock->method('updateStateId')->willReturn($expectedState);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionAccessStateDao']);
    $app_DaoFactoryMock->method('getAuctionAccessStateDao')->willReturn($auctionAccessStateDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $isUpdated = $auctionAccessStateBo->updateStateId(42, 42);

    $this->assertSame($expectedState, $isUpdated);
  }

  /**
   * @test
   * @covers AuctionAccessStateBoImpl
   */
  public function deleteAuctionAccessStateByIdTest(): void
  {
    $expectedSuccess = true;

    $AuctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
    $AuctionAccessStateDaoImpMock = $this->createPartialMock(AuctionAccessStateDaoImpl::class, ['deleteAuctionAccessStateById']);
    $AuctionAccessStateDaoImpMock->method('deleteAuctionAccessStateById')->willReturn($expectedSuccess);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionAccessStateDao']);
    $app_DaoFactoryMock->method('getAuctionAccessStateDao')->willReturn($AuctionAccessStateDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $success = $AuctionAccessStateBo->deleteAuctionAccessStateById(42);

    $this->assertSame($expectedSuccess, $success);
  }

  /**
   * @test
   * @covers AuctionAccessStateBoImpl
   */
  public function selectAllAuctionAccessStateBySellerIdAndStateIdTest(): void
  {
    $sellerId = 1;
    $stateId = 0;

    $expectedAuctionAccessState = new AuctionAccessStateModel();
    $expectedAuctionAccessState
        ->setId(42)
        ->setAuction($expectedAuctionAccessState->getAuction()->setId(1)->setSellerId($sellerId))
        ->setBidder($expectedAuctionAccessState->getBidder()->setId(1))
        ->setStateId($stateId);

    $expectedAuctionAccessStateList = [$expectedAuctionAccessState];

    $AuctionAccessStateBo = App_BoFactory::getFactory()->getAuctionAccessStateBo();
    $AuctionAccessStateDaoImpMock = $this->createPartialMock(AuctionAccessStateDaoImpl::class, ['selectAllAuctionAccessStateBySellerIdAndStateId']);
    $AuctionAccessStateDaoImpMock->method('selectAllAuctionAccessStateBySellerIdAndStateId')->willReturn($expectedAuctionAccessStateList);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionAccessStateDao']);
    $app_DaoFactoryMock->method('getAuctionAccessStateDao')->willReturn($AuctionAccessStateDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $AuctionAccessStateList = $AuctionAccessStateBo->selectAllAuctionAccessStateBySellerIdAndStateId($sellerId, $stateId);

    $this->assertEquals($expectedAuctionAccessStateList, $AuctionAccessStateList);
  }
}
