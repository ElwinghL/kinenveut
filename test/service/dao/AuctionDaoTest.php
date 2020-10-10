<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class AuctionDaoTest extends TestCase
{
  private $dbTampon;

  const SELLER_ID = 1;
  const CATEGORY_ID = 1;
  const PRIVACY_ID = 0;
  const NAME = 'Object Test';
  const DESCRIPTION = 'descr';
  const BASE_PRICE = 3;
  const RESERVE_PRICE = 10;
  const DURATION = 7;

  private $auctionDao;
  private $auctionTest;

  public function allFunctionToTest(): array
  {
    return [
      ['insertAuction', 1, new AuctionModel()],
      ['selectAuctionByAuctionId', 1, 0],
      ['updateStartDateAndAuctionState', 1, new AuctionModel()],
      ['updateAuctionState', 1, new AuctionModel()],
      ['deleteAuctionById', 1, 0],
      ['selectAllAuctionsByAuctionState', 1, 0],
      ['selectAllAuctionsBySellerId', 1, 0],
      ['selectAuctionByAuctionId', 1, 0],
      ['selectAcceptedConfidentialAuctionsByBidderId', 1, 0],
      ['selectAllAuctionsByBidderId', 1, 0]
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
      ->setCategoryId(self::CATEGORY_ID)
      ->setStartDate(new DateTime());
  }

  /** @after */
  public function tearDown(): void
  {
    parent::tearDown();
    setDb($this->dbTampon);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
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
        $this->auctionDao->$function($arg1);
        break;
      default:
        new Exception('nbArg not write');
    }
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function insertAuctionTest(): void
  {
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    $this->assertNotNull($auctionId);
    $this->assertTrue($auctionId > 0);

    $this->auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAuctionByAuctionIdTest()
  {
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    $auctionSelected = $this->auctionDao->selectAuctionByAuctionId($auctionId);

    $this->assertNotNull($auctionSelected);
    $this->assertSame($this->auctionTest->getName(), $auctionSelected->getName());

    $this->auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function updateStartDateAndAuctionStateTest(): void
  {
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);
    $auctionInserted = $this->auctionDao->selectAuctionByAuctionId($auctionId);

    $this->auctionTest
      ->setId($auctionId)
      ->setAuctionState(1);

    $this->assertTrue($this->auctionDao->updateStartDateAndAuctionState($this->auctionTest));
    $auctionUpdated = $this->auctionDao->selectAuctionByAuctionId($auctionId);

    $this->assertSame($auctionInserted->getId(), $auctionUpdated->getId());
    $this->assertNotSame($auctionInserted->getAuctionState(), $auctionUpdated->getAuctionState());

    $this->auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function updateAuctionStateTest(): void
  {
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);
    $auctionInserted = $this->auctionDao->selectAuctionByAuctionId($auctionId);

    $this->auctionTest
      ->setId($auctionId)
      ->setAuctionState(1);

    $this->assertTrue($this->auctionDao->updateAuctionState($this->auctionTest));
    $auctionUpdated = $this->auctionDao->selectAuctionByAuctionId($auctionId);

    $this->assertSame($auctionInserted->getId(), $auctionUpdated->getId());
    $this->assertNotSame($auctionInserted->getAuctionState(), $auctionUpdated->getAuctionState());

    $this->auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function deleteAuctionTest(): void
  {
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    $success = $this->auctionDao->deleteAuctionById($auctionId);

    $this->assertTrue($success);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAllAuctionsByAuctionStateTest(): void
  {
    $auctionState = 0;
    $this->auctionTest->setAuctionState($auctionState);

    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    $AuctionsSelected = $this->auctionDao->selectAllAuctionsByAuctionState($auctionState);

    $this->assertTrue(is_array($AuctionsSelected));
    $this->assertNotNull($AuctionsSelected[0]->getName());

    $this->auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAllAuctionsBySellerIdTest(): void
  {
    $this->auctionTest->setAuctionState(1);

    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    $AuctionsSelected = $this->auctionDao->selectAllAuctionsBySellerId(self::SELLER_ID);

    $this->assertTrue(is_array($AuctionsSelected));
    $this->assertNotNull($AuctionsSelected[0]->getName());

    $this->auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function getBestBidFrom_selectAuctionByAuctionIdTest(): void
  {
    /*Second step : insert the auction*/
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    /*Third step : create a bid*/
    $bidHistoryDao = App_DaoFactory::getFactory()->getBidHistoryDao();

    $bidTest = new BidModel();
    $bidTest
      ->setBidPrice(42)
      ->setBidDate('2020-10-01')
      ->setBidderId(1)
      ->setObjectId($auctionId);

    /*Fourth step : insert the bid*/
    $bidHistoryId = $bidHistoryDao->insertBid($bidTest);

    /*Fifth step : select an auction with the best bid**/
    $auctionSelected = $this->auctionDao->selectAuctionByAuctionId($auctionId);

    $this->assertNotNull($auctionSelected->getBestBid());
    $this->assertNotNull($auctionSelected->getBestBid()->getId());
    $this->assertTrue($auctionSelected->getBestBid()->getId() > 0);

    /*Sixth step : delete the inserted bid**/
    $bidHistoryDao->deleteBidById($bidHistoryId);

    /*Seventh step : delete the inserted auction**/
    $this->auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAcceptedConfidentialAuctionsByBidderId(): void
  {
    $this->auctionTest
      ->setAuctionState(1)
      ->setPrivacyId(2);

    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    /*Step two : Accept the auction*/
    $this->auctionTest
      ->setId($auctionId)
      ->setAuctionState(1);
    $this->auctionDao->updateStartDateAndAuctionState($this->auctionTest); //Auction acceptée

    /*Third step : Create an AAS and accept it*/
    $bidderId = 2;
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);
    $auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, 1); //AAS acceptée

    $AuctionsSelected = $this->auctionDao->selectAcceptedConfidentialAuctionsByBidderId($bidderId);

    $this->assertTrue(is_array($AuctionsSelected));
    $this->assertNotNull($AuctionsSelected[0]->getName());

    /*Last step : delete all what you inserted*/
    $this->auctionDao->deleteAuctionById($auctionId);
    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAllAuctionsByBidderIdTest(): void
  {
    /*Step one : create an auction*/
    $auctionId = $this->auctionDao->insertAuction($this->auctionTest);

    /*Second step : Create an AAS and accept it*/
    $bidderId = 2;
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);
    $auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, 1); //AAS acceptée

    $AuctionsSelected = $this->auctionDao->selectAllAuctionsByBidderId($bidderId);

    $this->assertTrue(is_array($AuctionsSelected));
    $this->assertNotNull($AuctionsSelected[0]->getName());

    /*Last step : delete all what you inserted*/
    $this->auctionDao->deleteAuctionById($auctionId);
    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }
}
