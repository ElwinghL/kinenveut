<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class BidHistoryDaoTest extends TestCase
{
  private $dbTampon;

  const AUCTION_ID = 1;
  const SELLER_ID = 1;
  const PRIVACY_ID = 1;
  const CATEGORY_ID = 1;
  const STATE_ID = 0;
  const NAME = 'Object Test';
  const DESCRIPTION = 'descr';
  const BASE_PRICE = 3;
  const RESERVE_PRICE = 10;
  const DURATION = 7;

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
      ->setBidDate(new DateTime(self::DATE))
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
      ['deleteBidById', 1, 0],
      ['deleteCurrentBidsByBidderId', 1, 0]
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

  /**
   * @test
   * @covers BidHistoryDaoImpl
   */
  public function deleteCurrentBidsByBidderIdTest() : void
  {
    //First step : insert a user
    App_DaoFactory::setFactory(new App_DaoFactory());
    $userDao = App_DaoFactory::getFactory()->getUserDao();
    $userTest = new UserModel();
    $userTest
          ->setFirstName('Francis')
          ->setLastName('Dupont')
          ->setBirthDate(new DateTime('1970-01-13'))
          ->setEmail('francis@kinenveut.fr')
          ->setPassword('password');
    $userId = $userDao->insertUser($userTest);

    App_DaoFactory::setFactory(new App_DaoFactory());
    $this->auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $this->auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $this->auctionTest = new AuctionModel();
    $this->auctionTest
            ->setName(self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->setBasePrice(self::BASE_PRICE)
            ->setReservePrice(self::RESERVE_PRICE)
            ->setDuration(self::DURATION)
            ->setSellerId(self::SELLER_ID)
            ->setPrivacyId(self::PRIVACY_ID)
            ->setCategoryId(self::CATEGORY_ID);

    //First step : Insert a new Auction
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    //Second step : Accept the Inserted Auction
    $localAuctionTest = $this->auctionTest
                          ->setId($auctionId)
                          ->setAuctionState(1);
    $auctionIsUpdated = $this->auctionDao->updateAuctionState($localAuctionTest);

    //Third step : Insert a BidHistory
    $bidHistoryId = $this->bidHistoryDao->insertBid($this->bidHistory);

    //Fourth step : Delete every online bids for one user
    $success = $this->bidHistoryDao->deleteCurrentBidsByBidderId(self::BIDDER_ID);

    //Delete inserted Auction & BidHistory & User
    $this->bidHistoryDao->deleteBidById($bidHistoryId);
    $this->auctionDao->deleteAuctionById($auctionId);
    $userDao->deleteUser($userId);

    $this->assertTrue($success);
    $this->assertTrue($this->bidHistoryDao->deleteCurrentBidsByBidderId(-1));
  }
}
