<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class AuctionDaoTest extends TestCase
{
  /** @before */
  public function setUp(): void
  {
    parent::setUp();
    App_DaoFactory::setFactory(new App_DaoFactory());
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function insertAuctionTest(): void
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setDuration(7)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);

    $this->assertNotNull($auctionId);
    $this->assertTrue($auctionId > 0);

    $auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAuctionByAuctionIdTest()
  {
    $currentDate = new DateTime();

    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setStartDate($currentDate)
            ->setDuration(7)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);

    $auctionSelected = $auctionDao->selectAuctionByAuctionId($auctionId);

    $this->assertNotNull($auctionSelected);
    $this->assertSame($auctionTest->getName(), $auctionSelected->getName());

    $auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function updateStartDateAndAuctionStateTest(): void
  {
    $currentDate = new DateTime();

    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setStartDate($currentDate)
            ->setDuration(7)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);
    $auctionInserted = $auctionDao->selectAuctionByAuctionId($auctionId);

    $auctionTest
            ->setId($auctionId)
            ->setStartDate($currentDate)
            ->setAuctionState(1);

    $auctionDao->updateStartDateAndAuctionState($auctionTest);
    $auctionUpdated = $auctionDao->selectAuctionByAuctionId($auctionId);

    $this->assertSame($auctionInserted->getId(), $auctionUpdated->getId());
    //$this->assertNotSame($auctionInserted->getStartDate(), $auctionUpdated->getStartDate());
    $this->assertNotSame($auctionInserted->getAuctionState(), $auctionUpdated->getAuctionState());

    $auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function updateAuctionStateTest(): void
  {
    $currentDate = new DateTime();

    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setStartDate($currentDate)
            ->setDuration(7)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);
    $auctionInserted = $auctionDao->selectAuctionByAuctionId($auctionId);

    $auctionTest
            ->setId($auctionId)
            ->setAuctionState(1);

    $auctionDao->updateAuctionState($auctionTest);
    $auctionUpdated = $auctionDao->selectAuctionByAuctionId($auctionId);

    $this->assertSame($auctionInserted->getId(), $auctionUpdated->getId());
    $this->assertNotSame($auctionInserted->getAuctionState(), $auctionUpdated->getAuctionState());

    $auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function deleteAuctionTest(): void
  {
    $currentDate = new DateTime();
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionTest = new AuctionModel();
    $auctionTest
        ->setName('Object Test')
        ->setDescription('descr')
        ->setBasePrice(3)
        ->setReservePrice(10)
        ->setStartDate($currentDate)
        ->setDuration(7)
        ->setSellerId(1)
        ->setPrivacyId(0)
        ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);

    $success = $auctionDao->deleteAuctionById($auctionId);

    $this->assertTrue($success);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAllAuctionsByAuctionStateTest(): void
  {
    $currentDate = new DateTime();
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionState = 0;

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setStartDate($currentDate)
            ->setDuration(7)
            ->setAuctionState($auctionState)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);

    $AuctionsSelected = $auctionDao->selectAllAuctionsByAuctionState($auctionState);

    $this->assertTrue(is_array($AuctionsSelected));
    $this->assertNotNull($AuctionsSelected[0]->getName());

    $auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAllAuctionsBySellerIdTest(): void
  {
    $currentDate = new DateTime();

    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $sellerId = 7;

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setStartDate($currentDate)
            ->setDuration(7)
            ->setAuctionState(1)
            ->setSellerId($sellerId)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);

    $AuctionsSelected = $auctionDao->selectAllAuctionsBySellerId($sellerId);

    $this->assertTrue(is_array($AuctionsSelected));
    $this->assertNotNull($AuctionsSelected[0]->getName());

    $auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function getBestBidFrom_selectAuctionByAuctionIdTest(): void
  {
    $currentDate = new DateTime();

    /*First step : create an auction*/
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setStartDate($currentDate)
            ->setDuration(7)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

    /*Second step : insert the auction*/
    $auctionId = $auctionDao->insertAuction($auctionTest);

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
    $auctionSelected = $auctionDao->selectAuctionByAuctionId($auctionId);

    $this->assertNotNull($auctionSelected->getBestBid());
    $this->assertNotNull($auctionSelected->getBestBid()->getId());
    $this->assertTrue($auctionSelected->getBestBid()->getId() > 0);

    /*Sixth step : delete the inserted bid**/
    $bidHistoryDao->deleteBidById($bidHistoryId);

    /*Seventh step : delete the inserted auction**/
    $auctionDao->deleteAuctionById($auctionId);
  }

  /**
   * @test
   * @covers AuctionDaoImpl
   */
  public function selectAcceptedConfidentialAuctionsByBidderId(): void
  {
    $currentDate = new DateTime();

    /*Step one : create an auction*/
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setStartDate($currentDate)
            ->setDuration(7)
            ->setAuctionState(1)
            ->setSellerId(1)
            ->setPrivacyId(2)
            ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);

    /*Step two : Accept the auction*/
    $auctionTest
        ->setId($auctionId)
        ->setAuctionState(1);
    $auctionDao->updateStartDateAndAuctionState($auctionTest); //Auction acceptée

    /*Third step : Create an AAS and accept it*/
    $bidderId = 2;
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);
    $auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, 1); //AAS acceptée

    $AuctionsSelected = $auctionDao->selectAcceptedConfidentialAuctionsByBidderId($bidderId);

    $this->assertTrue(is_array($AuctionsSelected));
    $this->assertNotNull($AuctionsSelected[0]->getName());

    /*Last step : delete all what you inserted*/
    $auctionDao->deleteAuctionById($auctionId);
    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }

  /**
    * @test
    * @covers AuctionDaoImpl
    */
  public function selectAllAuctionsByBidderIdTest() : void
  {
    /*Step one : create an auction*/
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
          ->setName('Object Test')
          ->setDescription('descr')
          ->setBasePrice(3)
          ->setReservePrice(10)
          ->setDuration(7)
          ->setSellerId(1)
          ->setPrivacyId(2)
          ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);

    /*Second step : Create an AAS and accept it*/
    $bidderId = 2;
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);
    $auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, 1); //AAS acceptée

    $AuctionsSelected = $auctionDao->selectAllAuctionsByBidderId($bidderId);

    $this->assertTrue(is_array($AuctionsSelected));
    $this->assertNotNull($AuctionsSelected[0]->getName());

    /*Last step : delete all what you inserted*/
    $auctionDao->deleteAuctionById($auctionId);
    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }
}
