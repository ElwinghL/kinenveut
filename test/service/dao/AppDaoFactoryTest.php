<?php

use PHPUnit\Framework\TestCase;

class AppDaoFactoryTest extends TestCase
{
  /** @before */
  public function setUp(): void
  {
    parent::setUp();
    App_DaoFactory::setFactory(null);
  }

  /**
   * @test
   * @covers App_DaoFactory
   */
  public function factoryTest(): void
  {
    $factory = App_DaoFactory::getFactory();
    $this->assertNotNull($factory);
    $this->assertInstanceOf(App_DaoFactory::class, $factory);

    $appDaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, []);
    App_DaoFactory::setFactory($appDaoFactoryMock);
    $this->assertNotNull(App_DaoFactory::getFactory());
    $this->assertSame($appDaoFactoryMock, App_DaoFactory::getFactory());
  }

  /**
   * @test
   * @covers App_DaoFactory
   */
  public function getUserDaoTest(): void
  {
    $this->assertInstanceOf(UserDaoImpl::class, App_DaoFactory::getFactory()->getUserDao());
  }

  /**
   * @test
   * @covers App_DaoFactory
   */
  public function getAuctionDaoTest(): void
  {
    $this->assertInstanceOf(AuctionDaoImpl::class, App_DaoFactory::getFactory()->getAuctionDao());
  }

  /**
   * @test
   * @covers App_DaoFactory
   */
  public function getCategoryDaoTest(): void
  {
    $this->assertInstanceOf(CategoryDaoImpl::class, App_DaoFactory::getFactory()->getCategoryDao());
  }

  /**
   * @test
   * @covers App_DaoFactory
   */
  public function getBidHistoryDaoTest(): void
  {
    $this->assertInstanceOf(BidHistoryDaoImpl::class, App_DaoFactory::getFactory()->getBidHistoryDao());
  }

  /**
 * @test
 * @covers App_DaoFactory
 */
  public function getAuctionAccessStateDaoTest(): void
  {
    $this->assertInstanceOf(AuctionAccessStateDaoImpl::class, App_DaoFactory::getFactory()->getAuctionAccessStateDao());
  }
}
