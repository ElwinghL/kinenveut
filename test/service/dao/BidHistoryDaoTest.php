<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class BidHistoryDaoTest extends TestCase
{
  /** @before */
  public function setUp(): void
  {
    parent::setUp();
    App_DaoFactory::setFactory(new App_DaoFactory());
  }

  /**
   * @test
   * @covers
   */
  public function insertBidTest(): void
  {
    $bidHistoryDao = App_DaoFactory::getFactory()->getBidHistoryDao();

    $bidHistoryTest = new BidModel();
    $bidHistoryTest
            ->setBidPrice(42)
            ->setBidDate('2020-10-01')
            ->setBidderId(1)
            ->setObjectId(1);

    $bidHistoryId = $bidHistoryDao->insertBid($bidHistoryTest);

    $this->assertNotNull($bidHistoryId);
    $this->assertTrue($bidHistoryId > 0);

    $bidHistoryDao->deleteBidById($bidHistoryId);
  }

  /**
   * @test
   * @covers
   */
  public function deleteBidTest(): void
  {
    $bidHistoryDao = App_DaoFactory::getFactory()->getBidHistoryDao();
    $bidHistoryTest = new BidModel();
    $bidHistoryTest
        ->setBidPrice(42)
        ->setBidDate('2020-10-01')
        ->setBidderId(1)
        ->setObjectId(1);

    $bidHistoryId = $bidHistoryDao->insertBid($bidHistoryTest);

    $success = $bidHistoryDao->deleteBidById($bidHistoryId);

    $this->assertTrue($success);
  }
}
