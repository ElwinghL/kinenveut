<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class AuctionAccessStateDaoTest extends TestCase
{
  /** @before */
  public function setUp(): void
  {
    parent::setUp();
    App_DaoFactory::setFactory(new App_DaoFactory());
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   * @throws BDDException
   */
  public function insertAuctionAccessStateTest(): void
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();

    $auctionId = 1;
    $bidderId = 1;

    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);

    $this->assertNotNull($auctionAccessStateId);
    $this->assertTrue($auctionAccessStateId > 0);

    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   * @throws BDDException
   */
  public function deleteAuctionAccessStateByIdTest(): void
  {
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();

    $auctionId = 1;
    $bidderId = 1;

    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);

    $success = $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);

    $this->assertTrue($success);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   * @throws BDDException
   */
  public function updateStateIdByAuctionAccessStateIdTest(): void
  {
    //Todo : vérifier l'update
    $newStateId = 1;

    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();

    $auctionId = 1;
    $bidderId = 1;

    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);

    $success = $auctionAccessStateDao->updateStateIdByAuctionAccessStateId($auctionAccessStateId, $newStateId);

    $this->assertTrue($success);

    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   * @throws BDDException
   */
  public function updateStateIdByAuctionIdAndBidderIdTest(): void
  {
    //Todo : vérifier l'update
    $newStateId = 1;

    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();

    $auctionId = 1;
    $bidderId = 1;

    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);

    $success = $auctionAccessStateDao->updateStateIdByAuctionIdAndBidderId($auctionId, $bidderId, $newStateId);

    $this->assertTrue($success);

    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   * @throws BDDException
   */
  public function selectAuctionAccessStateByAuctionIdAndBidderIdTest(): void
  {
    /*First step : create an auction & insert it*/
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
            ->setName('Object Test')
            ->setDescription('descr')
            ->setBasePrice(3)
            ->setReservePrice(10)
            ->setDuration(7)
            ->setSellerId(1)
            ->setPrivacyId(1)
            ->setCategoryId(1);

    $auctionId = $auctionDao->insertAuction($auctionTest);

    /*Second step : create an auctionAccessState*/
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();

    $bidderId = 1;

    /*Third step : insert the auctionAccessState*/
    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);

    /*Fourth step : select an auctionAccessState*/
    $auctionAccessStateSelected = $auctionAccessStateDao->selectAuctionAccessStateByAuctionIdAndBidderId($auctionId, $bidderId);

    /*TEST*/
    $this->assertNotNull($auctionAccessStateSelected->getId());
    $this->assertSame($auctionAccessStateId, $auctionAccessStateSelected->getId());

    $this->assertNotNull($auctionAccessStateSelected->getAuction());
    $this->assertTrue($auctionAccessStateSelected->getAuction()->getId() > 0);

    $this->assertNotNull($auctionAccessStateSelected->getBidder());
    $this->assertTrue($auctionAccessStateSelected->getBidder()->getId() > 0);

    $this->assertNotNull($auctionAccessStateSelected->getStateId());
    $this->assertTrue($auctionAccessStateSelected->getStateId() >= 0);

    /*Last step : delete the inserted auction & auctionAccessState*/
    $auctionDao->deleteAuctionById($auctionId);
    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   * @throws BDDException
   */
  public function selectAllAuctionAccessStateBySellerIdAndStateIdTest(): void
  {
    $sellerId = 1;
    $stateId = 0;

    /*First step : create an auction & insert it*/
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionTest = new AuctionModel();
    $auctionTest
          ->setName('Object Test')
          ->setDescription('descr')
          ->setBasePrice(3)
          ->setReservePrice(10)
          ->setDuration(7)
          ->setSellerId($sellerId)
          ->setPrivacyId(1)
          ->setCategoryId(1);

    $auctionTestId = $auctionDao->insertAuction($auctionTest);

    /*Second step : create an auctionAccessState*/
    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();

    $auctionId = $auctionTestId;
    $bidderId = 1;

    /*Third step : insert the auctionAccessState*/
    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionId, $bidderId);

    /*Fourth step : select an auctionAccessState*/
    $auctionAccessStateSelectedList = $auctionAccessStateDao->selectAllAuctionAccessStateBySellerIdAndStateId($sellerId, $stateId);

    /*TEST*/
    $auctionAccessStateSelected = $auctionAccessStateSelectedList[0];

    $this->assertNotNull($auctionAccessStateSelected->getId());
    $this->assertTrue($auctionAccessStateSelected->getId() > 0);

    $this->assertSame($auctionAccessStateSelected->getStateId(), $stateId);

    $this->assertNotNull($auctionAccessStateSelected->getAuction());
    $this->assertTrue($auctionAccessStateSelected->getAuction()->getId() > 0);
    $this->assertSame($auctionAccessStateSelected->getAuction()->getSellerId(), $sellerId);

    $this->assertNotNull($auctionAccessStateSelected->getBidder());
    $this->assertTrue($auctionAccessStateSelected->getBidder()->getId() > 0);

    /*Last step : delete the inserted auction & auctionAccessState*/
    $auctionDao->deleteAuctionById($auctionTestId);
    $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);
  }
}
