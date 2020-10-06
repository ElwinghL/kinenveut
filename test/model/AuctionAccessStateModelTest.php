<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class AuctionAccessStateModelTest extends TestCase
{
  /**
   * @test
   * @covers AuctionAccessStateModel
   */
  public function getterSetterTest()
  {
    $auctionAccessState = new AuctionAccessStateModel();
    $id = 1;
    $stateId = 0;

    $auction = new AuctionModel();
    $auction
        ->setId(1)
        ->setName('Auction test');

    $bidder = new UserModel();
    $bidder
        ->setId(1)
        ->setFirstName('Georges')
        ->setLastName('DeLaJungle');

    $auctionAccessState
        ->setId($id)
        ->setStateId($stateId)
        ->setAuction($auction)
        ->setBidder($bidder);

    $this->assertSame($auctionAccessState->getId(), $id);
    $this->assertEquals($auctionAccessState->getAuction(), $auction);
    $this->assertEquals($auctionAccessState->getBidder(), $bidder);
    $this->assertSame($auctionAccessState->getStateId(), $stateId);
  }
}
