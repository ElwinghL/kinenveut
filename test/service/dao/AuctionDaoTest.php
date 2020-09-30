<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class AuctionDaoTest extends TestCase
{
  /** @before*/
  public function setUp() : void
  {
    parent::setUp();

    App_DaoFactory::setFactory(new App_DaoFactory());
  }

  public function insertAuctionTest():void
  {
    //todo
        /*Creation of the AuctionModel
        $auctionForTest = new AuctionModel();
        $auctionForTest
            ->setName('ObjetDeTest')
            ->setDescription('Ma description de test')
            ->setBasePrice(4)
            ->setReservePrice(50)
            ->setPictureLink('')
            ->setStartDate('2020-09-30 12:00:00')
            ->setDuration(7)
            ->setAuctionState(-1)
            ->setSellerId(1)
            ->setPrivacyId(0)
            ->setCategoryId(1);

        $auctionDao = App_DaoFactory::getFactory()->getAuctionDao();
        $auction = $auctionDao->insertAuction($auctionForTest);

        $this->assertNotNull($auction->getId());*/

        //$auctionDao->deleteAuction($auctionForTest);
  }

  public function deleteAuctionTest():void
  {
    //todo
  }
}
