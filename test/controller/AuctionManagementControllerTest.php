<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class AuctionManagementControllerTest extends TestCase
{
  /**
   * @test
   * @covers AuctionManagementController
   */
  public function indexTest()
  {
    $auction = new AuctionModel();

    $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAllAuctionsByAuctionState']);
    $auctionBoMock->method('selectAllAuctionsByAuctionState')->willReturn([$auction]);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
    $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $auctionManagementController = new AuctionManagementController();
    $data = $auctionManagementController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(
      [
        'auctions' => [$auction]
      ],
      $data[2]
    );
  }

  /**
   * @test
   * @covers AuctionManagementController
   */
  public function validateTest()
  {
    setParameters(['id' => 42]);

    $auction = new AuctionModel();

    $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAuctionByAuctionId', 'updateStartDateAndAuctionState', 'selectAllAuctionsByAuctionState']);
    $auctionBoMock->method('selectAuctionByAuctionId')->willReturn($auction);
    $auctionBoMock->method('updateStartDateAndAuctionState')->willReturn(true);
    $auctionBoMock->method('selectAllAuctionsByAuctionState')->willReturn([$auction]);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
    $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $auctionManagementController = new AuctionManagementController();
    $data = $auctionManagementController->validate();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(
      [
        'auctions' => [$auction]
      ],
      $data[2]
    );
  }

  /**
   * @test
   * @covers AuctionManagementController
   */
  public function deleteTest()
  {
    setParameters(['id' => 42]);

    $auction = new AuctionModel();

    $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAuctionByAuctionId', 'updateStartDateAndAuctionState', 'selectAllAuctionsByAuctionState']);
    $auctionBoMock->method('selectAuctionByAuctionId')->willReturn($auction);
    $auctionBoMock->method('updateStartDateAndAuctionState')->willReturn(true);
    $auctionBoMock->method('selectAllAuctionsByAuctionState')->willReturn([$auction]);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
    $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $auctionManagementController = new AuctionManagementController();
    $data = $auctionManagementController->delete();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(
      [
        'auctions' => [$auction]
      ],
      $data[2]
    );
  }
}
