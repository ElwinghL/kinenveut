<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class AuctionAccessStateDaoTest extends TestCase
{
  private $dbTampon;

  const AUCTION_ID = 1;
  const BIDDER_ID = 1;
  const SELLER_ID = 1;
  const PRIVACY_ID = 1;
  const CATEGORY_ID = 1;
  const STATE_ID = 0;
  const NAME = 'Object Test';
  const DESCRIPTION = 'descr';
  const BASE_PRICE = 3;
  const RESERVE_PRICE = 10;
  const DURATION = 7;

  private $auctionAccessStateDao;
  private $auctionDao;
  private $auctionTest;

  public function allFunctionToTest(): array
  {
    return [
      ['insertAuctionAccessState', 2, 0, 0, null],
      ['deleteAuctionAccessStateById', 1, 0, null, null],
      ['updateStateIdByAuctionAccessStateId', 2, 0, 0, null],
      ['updateStateIdByAuctionIdAndBidderId', 3, 0, 0, 0],
      ['selectAuctionAccessStateByAuctionIdAndBidderId', 2, 0, 0, null],
      ['selectAllAuctionAccessStateBySellerIdAndStateId', 2, 0, 0, null],
      ['selectNumberOfAuctionAccessStateBySellerId', 1, 0, null, null]
    ];
  }

  /** @before */
  public function setUp(): void
  {
    parent::setUp();
    if ($this->dbTampon == null) {
      $this->dbTampon = db();
    }
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
  }

  /** @after */
  public function tearDown(): void
  {
    parent::tearDown();
    setDb($this->dbTampon);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   * @dataProvider allFunctionToTest
   */
  public function dbTest($function, $nbArg, $arg1, $arg2, $arg3): void
  {
    global $db;
    $db = $this->createPartialMock(PDO::class, ['prepare', 'query']);
    $db->method('prepare')->willThrowException(new PDOException());
    $db->method('query')->willThrowException(new PDOException());

    $this->expectException(BDDException::class);

    switch ($nbArg) {
      case 1:
        $this->auctionAccessStateDao->$function($arg1);
        break;
      case 2:
        $this->auctionAccessStateDao->$function($arg1, $arg2);
        break;
      case 3:
        $this->auctionAccessStateDao->$function($arg1, $arg2, $arg3);
        break;
      default:
        new Exception('nbArg not write');
    }
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   */
  public function insertAuctionAccessStateTest(): void
  {
    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState(self::AUCTION_ID, self::BIDDER_ID);

    $this->assertNotNull($auctionAccessStateId);
    $this->assertTrue($auctionAccessStateId > 0);

    $this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);

    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState(-1, -1);
    $this->assertNotNull($auctionAccessStateId);
    $this->assertTrue($auctionAccessStateId > 0);

    $this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   */
  public function deleteAuctionAccessStateByIdTest(): void
  {
    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState(self::AUCTION_ID, self::BIDDER_ID);

    $this->assertTrue($this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId));
    $this->assertTrue($this->auctionAccessStateDao->deleteAuctionAccessStateById(-1));
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   */
  public function updateStateIdByAuctionAccessStateIdTest(): void
  {
    $newStateId = 1;
    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState(self::AUCTION_ID, self::BIDDER_ID);

    $this->assertTrue($this->auctionAccessStateDao->updateStateIdByAuctionAccessStateId($auctionAccessStateId, $newStateId));

    $auctionAccessStateSelected = $this->auctionAccessStateDao->selectAuctionAccessStateByAuctionIdAndBidderId(self::AUCTION_ID, self::BIDDER_ID);

    $this->assertNotNull($auctionAccessStateSelected);
    $this->assertSame($newStateId, $auctionAccessStateSelected->getStateId());

    $this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);

    $this->assertTrue($this->auctionAccessStateDao->updateStateIdByAuctionAccessStateId(-1, -1));
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   */
  public function updateStateIdByAuctionIdAndBidderIdTest(): void
  {
    $newStateId = 1;
    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState(self::AUCTION_ID, self::BIDDER_ID);

    $this->assertTrue($this->auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId(self::AUCTION_ID, self::BIDDER_ID, $newStateId));

    $auctionAccessStateSelected = $this->auctionAccessStateDao->selectAuctionAccessStateByAuctionIdAndBidderId(self::AUCTION_ID, self::BIDDER_ID);

    $this->assertNotNull($auctionAccessStateSelected);
    $this->assertSame($newStateId, $auctionAccessStateSelected->getStateId());

    $this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);

    $this->assertTrue($this->auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId(-1, -1, -1));
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   */
  public function cancelAuctionAccessStateByUserIdTest() : void
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

    //First step : Insert a new Auction
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    //Second step : Insert a new AAS
    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState($auctionId, $userId);

    //Third step : Accept the Inserted Auction
    $localAuctionTest = $this->auctionTest
                          ->setId($auctionId)
                          ->setAuctionState(1);
    $auctionIsUpdated = $this->auctionDao->updateAuctionState($localAuctionTest);

    //Forth step : Cancel all the AAS for the user
    $this->assertTrue($this->auctionAccessStateDao->cancelAuctionAccessStateByUserId($userId));

    //Fifth step : Select last inserted AAS
    $auctionAccessStateSelected = $this->auctionAccessStateDao->selectAuctionAccessStateByAuctionIdAndBidderId($auctionId, $userId);

    $this->assertNotNull($auctionAccessStateSelected);
    $this->assertSame(2, $auctionAccessStateSelected->getStateId());

    //Delete inserted Auction & AAS & User
    $this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
    $this->auctionDao->deleteAuctionById($auctionId);
    $userDao->deleteUser($userId);

    $this->assertTrue($this->auctionAccessStateDao->cancelAuctionAccessStateByUserId($userId));
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   */
  public function selectAuctionAccessStateByAuctionIdAndBidderIdTest(): void
  {
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);
    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState($auctionId, self::BIDDER_ID);

    $auctionAccessStateSelected = $this->auctionAccessStateDao->selectAuctionAccessStateByAuctionIdAndBidderId($auctionId, self::BIDDER_ID);

    $this->assertNotNull($auctionAccessStateSelected->getId());
    $this->assertSame($auctionAccessStateId, $auctionAccessStateSelected->getId());
    $this->assertNotNull($auctionAccessStateSelected->getAuction());
    $this->assertTrue($auctionAccessStateSelected->getAuction()->getId() > 0);
    $this->assertNotNull($auctionAccessStateSelected->getBidder());
    $this->assertTrue($auctionAccessStateSelected->getBidder()->getId() > 0);
    $this->assertNotNull($auctionAccessStateSelected->getStateId());
    $this->assertTrue($auctionAccessStateSelected->getStateId() >= 0);

    $this->auctionDao->deleteAuctionById($auctionId);
    $this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);

    $this->assertNull($this->auctionAccessStateDao->selectAuctionAccessStateByAuctionIdAndBidderId($auctionId, self::BIDDER_ID));
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   */
  public function selectAllAuctionAccessStateBySellerIdAndStateIdTest(): void
  {
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);
    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState($auctionId, self::BIDDER_ID);

    $auctionAccessStateSelectedList = $this->auctionAccessStateDao->selectAllAuctionAccessStateBySellerIdAndStateId(self::BIDDER_ID, self::STATE_ID);

    $this->assertNotNull($auctionAccessStateSelectedList[0]->getId());
    $this->assertTrue($auctionAccessStateSelectedList[0]->getId() > 0);
    $this->assertSame($auctionAccessStateSelectedList[0]->getStateId(), self::STATE_ID);
    $this->assertNotNull($auctionAccessStateSelectedList[0]->getAuction());
    $this->assertTrue($auctionAccessStateSelectedList[0]->getAuction()->getId() > 0);
    $this->assertSame($auctionAccessStateSelectedList[0]->getAuction()->getSellerId(), self::SELLER_ID);
    $this->assertNotNull($auctionAccessStateSelectedList[0]->getBidder());
    $this->assertTrue($auctionAccessStateSelectedList[0]->getBidder()->getId() > 0);

    $this->auctionDao->deleteAuctionById($auctionId);
    $this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   */
  public function selectNumberOfAuctionAccessStateBySellerIdTest(): void
  {
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);
    $auctionAccessStateId = $this->auctionAccessStateDao->insertAuctionAccessState($auctionId, self::BIDDER_ID);

    $numberOfAAS = $this->auctionAccessStateDao->selectNumberOfAuctionAccessStateBySellerId(self::SELLER_ID);

    $this->assertNotNull($numberOfAAS);
    $this->assertTrue($numberOfAAS > 0);

    $this->auctionDao->deleteAuctionById($auctionId);
    $this->auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }
}
