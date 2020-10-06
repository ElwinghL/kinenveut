<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class BidModelTest extends TestCase
{
  /**
   * @test
   * @covers BidModel
  */
  public function getterSetterTest()
  {
    $bid = new BidModel();
    $id = 'testBid';
    $bidPrice = 20;
    $bidDate = new DateTime();
    $objectId = 'testObject';
    $bidderId = 'testUser';

    $bid
      ->setId($id)
      ->setBidPrice($bidPrice)
      ->setBidDate($bidDate)
      ->setObjectId($objectId)
      ->setBidderId($bidderId);

    $this->assertSame($bid->getId(), $id);
    $this->assertSame($bid->getBidPrice(), $bidPrice);
    $this->assertSame($bid->getBidDate(), $bidDate);
    $this->assertSame($bid->getObjectId(), $objectId);
    $this->assertSame($bid->getBidderId(), $bidderId);
  }
}
