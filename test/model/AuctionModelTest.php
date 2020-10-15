<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class AuctionModelTest extends TestCase
{
  /**
   * @test
   * @covers AuctionModel
  */
  public function getterSetterTest()
  {
    $auction = new AuctionModel();
    $id = 0;
    $name = 'Ma belle Auction';
    $description = 'Vend un OBJECT pour cause de PAS UTILISE';
    $basePrice = 0;
    $reservePrice = 100;
    $pictureLink = 'www.perdu.com';
    $startDate = new DateTime();
    $duration = 14;
    $auctionState = 0;
    $sellerId = 0;
    $privacyId = 0;
    $categoryId = 0;

    $auction
      ->setId($id)
      ->setName($name)
      ->setDescription($description)
      ->setBasePrice($basePrice)
      ->setReservePrice($reservePrice)
      ->setPictureLink($pictureLink)
      ->setStartDate($startDate)
      ->setDuration($duration)
      ->setAuctionState($auctionState)
      ->setSellerId($sellerId)
      ->setPrivacyId($privacyId)
      ->setCategoryId($categoryId);

    $this->assertSame($auction->getId(), $id);
    $this->assertSame($auction->getName(), $name);
    $this->assertSame($auction->getDescription(), $description);
    $this->assertSame($auction->getBasePrice(), $basePrice);
    $this->assertSame($auction->getReservePrice(), $reservePrice);
    $this->assertSame($auction->getPictureLink(), $pictureLink);
    $this->assertSame($auction->getStartDate(), $startDate);
    $this->assertSame($auction->getDuration(), $duration);
    $this->assertSame($auction->getAuctionState(), $auctionState);
    $this->assertSame($auction->getSellerId(), $sellerId);
    $this->assertSame($auction->getPrivacyId(), $privacyId);
    $this->assertSame($auction->getCategoryId(), $categoryId);

    $bestBid = new BidModel();
    $bidId = 0;
    $bidPrice = 20;
    $bidDate = new DateTime();
    $objectId = 0;
    $bidderId = 0;

    $bestBid
      ->setId($bidId)
      ->setBidPrice($bidPrice)
      ->setBidDate($bidDate)
      ->setObjectId($objectId)
      ->setBidderId($bidderId);
    $auction->setBestBid($bestBid);

    $this->assertSame($auction->getBestBid(), $bestBid);
  }
}
