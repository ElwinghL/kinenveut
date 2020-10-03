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
   * @covers
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
            //->setCreationDate(creationDate)
            ->setStartDate('2020-01-01')
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
   * @covers
   */
  public function deleteAuctionTest(): void
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
    $auctionTest = new AuctionModel();
    $auctionTest
        ->setName('Object Test')
        ->setDescription('descr')
        ->setBasePrice(3)
        ->setReservePrice(10)
        //->setCreationDate(creationDate)
        ->setStartDate('2020-01-01')
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
   * @covers
   */
  public function selectAllAuctionsByAuctionStateTest(): void
  {
    $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();

    $auctionState = 0;

    $auctionTest = new AuctionModel();
    $auctionTest
        ->setName('Object Test')
        ->setDescription('descr')
        ->setBasePrice(3)
        ->setReservePrice(10)
        //->setCreationDate(creationDate)
        ->setStartDate('2020-01-01')
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
}
