<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class BidControllerTest extends TestCase
{
  /**
   * @test
   * @covers BidController
   */
  public function indexTest()
  {
    $_SESSION['userId'] = 42;
    setParameters(['auctionId' => 42]);

    $auction = new AuctionModel();
    $auction->setName('Maillot de bain');
    $auction->setSellerId(1);
    $auction->setPrivacyId(1);
    $auction->setCategoryId(1);

    $seller = new UserModel();

    $auctionAccessState = new AuctionAccessStateModel();

    $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAuctionByAuctionId']);
    $auctionBoMock->method('selectAuctionByAuctionId')->willReturn($auction);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->willReturn($seller);

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImpl::class, ['selectAuctionAccessStateByAuctionIdAndBidderId']);
    $auctionAccessStateBoMock->method('selectAuctionAccessStateByAuctionIdAndBidderId')->willReturn($auctionAccessState);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo', 'getUserBo', 'getAuctionAccessStateBo']);
    $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    $app_BoFactoryMock->method('getAuctionAccessStateBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $bidController = new BidController();
    $data = $bidController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(
      [
        'return' => '?home',
        'auction'            => $auction,
        'seller'             => $seller,
        'auctionAccessState' => $auctionAccessState
      ],
      $data[2]
    );

    unset($_SESSION['userId']);
  }

  /**
   * @test
   * @covers BidController
   */
  public function indexNoAuctionTest()
  {
    $_SESSION['userId'] = 42;
    setParameters(['auctionId' => 42]);

    $seller = new UserModel();

    $auctionAccessState = new AuctionAccessStateModel();

    $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAuctionByAuctionId']);
    $auctionBoMock->method('selectAuctionByAuctionId')->willReturn(null);

    $userBoMock = $this->createPartialMock(UserBoImpl::class, ['selectUserByUserId']);
    $userBoMock->method('selectUserByUserId')->willReturn($seller);

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImpl::class, ['selectAuctionAccessStateByAuctionIdAndBidderId']);
    $auctionAccessStateBoMock->method('selectAuctionAccessStateByAuctionIdAndBidderId')->willReturn($auctionAccessState);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo', 'getUserBo', 'getAuctionAccessStateBo']);
    $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
    $app_BoFactoryMock->method('getUserBo')->willReturn($userBoMock);
    $app_BoFactoryMock->method('getAuctionAccessStateBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $bidController = new BidController();
    $data = $bidController->index();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=home', $data[1]);

    unset($_SESSION['userId']);
  }

  /**
   * @test
   * @covers BidController
   */
  public function addBid()
  {
      $_SERVER['REQUEST_METHOD'] = 'POST';

    $_SESSION['userId'] = 42;
    $auctionId = 42;
    setParameters(['auctionId' => $auctionId, 'bidPrice' => '15']);

    $bidHistoryBoMock = $this->createPartialMock(BidHistoryBoImpl::class, ['insertBid']);
    $bidHistoryBoMock->method('insertBid')->willReturn(15);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getBidHistoryBo']);
    $app_BoFactoryMock->method('getBidHistoryBo')->willReturn($bidHistoryBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $bidController = new BidController();
    $data = $bidController->addBid();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=bid', $data[1]);

    unset($_SESSION['userId']);
  }

  /**
   * @test
   * @covers BidController
   */
  public function addBidNoBidPriceTest()
  {
      $_SERVER['REQUEST_METHOD'] = 'POST';

    $auctionId = 42;
    setParameters(['auctionId' => $auctionId, 'bidPrice' => '']);

    $bidController = new BidController();
    $data = $bidController->addBid();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=bid', $data[1]);
    $this->assertSame(['auctionId' => $auctionId], $data[2]);
  }

  /**
     * @test
     * @covers BidController
     */
  public function makeAuctionAccessRequestTest()
  {
    $auctionId = 42;
    $_SESSION['userId'] = 42;
    setParameters(['auctionId' => $auctionId]);

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImpl::class, ['insertAuctionAccessState', 'updateStateIdByAuctionIdAndBidderId']);
    $auctionAccessStateBoMock->method('insertAuctionAccessState')->willReturn(5);
    $auctionAccessStateBoMock->method('updateStateIdByAuctionIdAndBidderId')->willReturn(false);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionAccessStateBo']);
    $app_BoFactoryMock->method('getAuctionAccessStateBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $bidController = new BidController();
    $data = $bidController->makeAuctionAccessRequest();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=bid', $data[1]);
    $this->assertSame(['auctionId' => $auctionId], $data[2]);
  }

  /**
   * @test
   * @covers BidController
   */
  public function cancelAuctionAccessRequestTest()
  {
    $auctionId = 42;
    $_SESSION['userId'] = 42;
    setParameters(['auctionId' => $auctionId]);

    $auctionAccessStateBoMock = $this->createPartialMock(AuctionAccessStateBoImpl::class, ['updateStateIdByAuctionIdAndBidderId']);
    $auctionAccessStateBoMock->method('updateStateIdByAuctionIdAndBidderId')->willReturn(true);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionAccessStateBo']);
    $app_BoFactoryMock->method('getAuctionAccessStateBo')->willReturn($auctionAccessStateBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $bidController = new BidController();
    $data = $bidController->cancelAuctionAccessRequest();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=bid', $data[1]);
    $this->assertSame(['auctionId' => $auctionId], $data[2]);
  }
}
