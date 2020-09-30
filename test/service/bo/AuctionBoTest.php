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

  /** @test */
  public function insertAuctionTest() : void
  {
    //todo
      /*
    $auctionBo = App_BoFactory::getFactory()->getAuctionBo();
    $auctionMock = $this->createPartialMock(AuctionModel::class, []);
    $auctionDaoImpMock = $this->createPartialMock(AuctionDaoImpl::class, ['insertAuction']);
    $auctionDaoImpMock->method('insertAuction')->willReturn($auctionMock);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getAuctionDao']);
    $app_DaoFactoryMock->method('getAuctionDao')->willReturn($auctionDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $auction = $auctionBo->insertAuction($auctionMock);

    $this->assertSame($auction, $auctionMock);*/
  }
}
