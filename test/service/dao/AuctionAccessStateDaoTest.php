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

    $auctionAccessStateTest = new AuctionAccessStateModel();
    $auctionAccessStateTest
        ->setAuction($auctionAccessStateTest->getAuction()->setId(1))
        ->setBidder($auctionAccessStateTest->getBidder()->setId(1))
        ->setStateId(1);

    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionAccessStateTest);

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
    $auctionAccessStateTest = new AuctionAccessStateModel();
    $auctionAccessStateTest
        ->setAuction($auctionAccessStateTest->getAuction()->setId(1))
        ->setBidder($auctionAccessStateTest->getBidder()->setId(1))
        ->setStateId(1);

    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionAccessStateTest);

    $success = $auctionAccessStateDao->deleteAuctionAccessStateById($auctionAccessStateId);

    $this->assertTrue($success);
  }

  /**
   * @test
   * @covers AuctionAccessStateDaoImpl
   * @throws BDDException
   */
  public function updateStateIdTest(): void
  {
    //Todo : vérifier l'update
    $newStateId = 1;

    $auctionAccessStateDao = App_DaoFactory::getFactory()->getAuctionAccessStateDao();
    $auctionAccessStateTest = new AuctionAccessStateModel();
    $auctionAccessStateTest
          ->setAuction($auctionAccessStateTest->getAuction()->setId(1))
          ->setBidder($auctionAccessStateTest->getBidder()->setId(1))
          ->setStateId(1);

    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionAccessStateTest);

    $success = $auctionAccessStateDao->updateStateId($auctionAccessStateId, $newStateId);

    $this->assertTrue($success);

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

    $auctionAccessStateTest = new AuctionAccessStateModel();
    $auctionAccessStateTest
        ->setAuction($auctionAccessStateTest->getAuction()->setId($auctionTestId)->setSellerId($sellerId))
        ->setBidder($auctionAccessStateTest->getBidder()->setId(1))
        ->setStateId($stateId);

    /*Third step : insert the auctionAccessState*/
    $auctionAccessStateId = $auctionAccessStateDao->insertAuctionAccessState($auctionAccessStateTest);

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
