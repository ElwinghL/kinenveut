<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class BidHistoryDaoTest extends TestCase
{
  private $dbTampon;

  const PRICE = 42;
  const DATE = '2020-10-01';
  const BIDDER_ID = 1;
  const OBJECTIF_ID = 1;

  private $bidHistoryDao;
  private $bidHistory;

  /** @before */
  public function setUp(): void
  {
    parent::setUp();
    if ($this->dbTampon == null) {
      $this->dbTampon = db();
    }
    App_DaoFactory::setFactory(new App_DaoFactory());
    $this->bidHistoryDao = App_DaoFactory::getFactory()->getBidHistoryDao();

    $this->bidHistory = new BidModel();
    $this->bidHistory
      ->setBidPrice(self::PRICE)
      ->setBidDate(self::DATE)
      ->setBidderId(self::BIDDER_ID)
      ->setObjectId(self::OBJECTIF_ID);
  }

  /** @after */
  public function tearDown() : void
  {
    parent::tearDown();
    setDb($this->dbTampon);
  }

  public function allFunctionToTest(): array
  {
    return [
      ['insertBid', 1, new BidModel()],
      ['deleteBidById', 1, 0]
    ];
  }

  /**
   * @test
   * @covers BidHistoryDaoImpl
   * @dataProvider allFunctionToTest
   */
  public function dbTest($function, $nbArg, $arg1): void
  {
    global $db;
    $db = $this->createPartialMock(PDO::class, ['prepare', 'query']);
    $db->method('prepare')->willThrowException(new PDOException());
    $db->method('query')->willThrowException(new PDOException());

    $this->expectException(BDDException::class);

    switch ($nbArg) {
      case 1:
        $this->bidHistoryDao->$function($arg1);
        break;
      default:
        new Exception('nbArg not write');
    }
  }

  /**
   * @test
   * @covers BidHistoryDaoImpl
   */
  public function insertBidTest(): void
  {
    $bidHistoryId = $this->bidHistoryDao->insertBid($this->bidHistory);

    $this->assertNotNull($bidHistoryId);
    $this->assertTrue($bidHistoryId > 0);

    $this->bidHistoryDao->deleteBidById($bidHistoryId);

    $this->expectException(BDDException::class);
    $bidHistoryEmpty = new BidModel();
    $this->bidHistoryDao->insertBid($bidHistoryEmpty);
  }

  /**
   * @test
   * @covers BidHistoryDaoImpl
   */
  public function deleteBidTest(): void
  {
    $bidHistoryId = $this->bidHistoryDao->insertBid($this->bidHistory);

    $success = $this->bidHistoryDao->deleteBidById($bidHistoryId);

    $this->assertTrue($success);
    $this->assertTrue($this->bidHistoryDao->deleteBidById(-1));
  }
}
