<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class BidHistoryBoTest extends TestCase
{
  /** @before */
  public function setUp(): void
  {
    parent::setUp();
    App_BoFactory::setFactory(new App_BoFactory());
  }

  /**
   * @test
   * @covers BidHistoryBoImpl
   */
  public function insertBidTest() : void
  {
    $expectedBidHistoryId = 42;
    $bidHistoryBo = App_BoFactory::getFactory()->getBidHistoryBo();
    $bidHistoryMock = $this->createPartialMock(BidModel::class, []);

    $bidHistoryDaoImpMock = $this->createPartialMock(BidHistoryDaoImpl::class, ['insertBid']);
    $bidHistoryDaoImpMock->method('insertBid')->willReturn($expectedBidHistoryId);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getBidHistoryDao']);
    $app_DaoFactoryMock->method('getBidHistoryDao')->willReturn($bidHistoryDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $bidHistoryId = $bidHistoryBo->insertBid($bidHistoryMock);

    $this->assertSame($expectedBidHistoryId, $bidHistoryId);
  }

  /**
   * @test
   * @covers BidHistoryBoImpl
   */
  public function deleteBidByIdTest(): void
  {
    $expectedSuccess = true;

    $bidHistoryBo = App_BoFactory::getFactory()->getBidHistoryBo();

    $bidHistoryDaoImpMock = $this->createPartialMock(BidHistoryDaoImpl::class, ['deleteBidById']);
    $bidHistoryDaoImpMock->method('deleteBidById')->willReturn($expectedSuccess);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getBidHistoryDao']);
    $app_DaoFactoryMock->method('getBidHistoryDao')->willReturn($bidHistoryDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $success = $bidHistoryBo->deleteBidById(42);

    $this->assertSame($expectedSuccess, $success);
  }
}
