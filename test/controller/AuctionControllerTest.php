<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class AuctionControllerTest extends TestCase
{
    /**
     * @test
     * @covers AuctionController
     */
    public function createTest()
    {
        $categoryList = [new CategoryModel()];

        $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
        $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getCategoryBo']);
        $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->create();

        $this->assertSame('render', $data[0]);
        $this->assertSame('create', $data[1]);
        $this->assertSame([
            'categoryList' => $categoryList
        ], $data[2]);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function sellsTest()
    {
        setParameters(['userId' => 42]);
        $_SESSION['userId'] = 42;
        $auctionList = [new AuctionModel()];

        $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAllAuctionsBySellerId']);
        $auctionBoMock->method('selectAllAuctionsBySellerId')->willReturn($auctionList);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
        $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->sells();

        $this->assertSame('render', $data[0]);
        $this->assertSame('index', $data[1]);
        $this->assertSame([
            'titlePage' => "Mes ventes",
            'auctionList' => $auctionList
        ], $data[2]);

        unset($_SESSION['userId']);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function sellsWithEmptyAuctionListTest()
    {
        setParameters(['userId' => 42]);
        $_SESSION['userId'] = 5;

        $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAllAuctionsBySellerId']);
        $auctionBoMock->method('selectAllAuctionsBySellerId')->willReturn([]);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
        $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->sells();

        $this->assertSame('render', $data[0]);
        $this->assertSame('index', $data[1]);
        $this->assertSame([
            'titlePage' => "Ses ventes"
        ], $data[2]);

        unset($_SESSION['userId']);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function bidsTest()
    {
        setParameters(['userId' => 42]);
        $_SESSION['userId'] = 42;
        $auctionList = [new AuctionModel()];
        $categoryList = [new CategoryModel()];

        $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAllAuctionsByBidderId']);
        $auctionBoMock->method('selectAllAuctionsByBidderId')->willReturn($auctionList);

        $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
        $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo', 'getCategoryBo']);
        $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
        $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->bids();

        $this->assertSame('render', $data[0]);
        $this->assertSame('index', $data[1]);
        $this->assertSame([
            'categoryList' => $categoryList,
            'titlePage' => "Mes enchères",
            'auctionList' => $auctionList
        ], $data[2]);

        unset($_SESSION['userId']);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function bidsUserNotBidderTest()
    {
        setParameters(['userId' => 42]);
        $_SESSION['userId'] = 5;

        $auctionController = new AuctionController();
        $data = $auctionController->bids();

        $this->assertSame('redirect', $data[0]);
        $this->assertSame('?r=home', $data[1]);

        unset($_SESSION['userId']);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function bidsWithEmptyAuctionListTest()
    {
        setParameters(['userId' => 42]);
        $_SESSION['userId'] = 42;

        $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAllAuctionsByBidderId']);
        $auctionBoMock->method('selectAllAuctionsByBidderId')->willReturn([]);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
        $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->bids();

        $this->assertSame('redirect', $data[0]);
        $this->assertSame('?r=home', $data[1]);

        unset($_SESSION['userId']);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function abortTest()
    {
        setParameters(['auctionId' => 42]);
        $_SESSION['userId'] = 42;
        $auction = new AuctionModel();
        $auction->setSellerId(42);

        $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAuctionByAuctionId']);
        $auctionBoMock->method('selectAuctionByAuctionId')->willReturn($auction);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
        $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->abort();

        $this->assertSame('redirect', $data[0]);
        $this->assertSame('?r=auction/sells', $data[1]);
        $this->assertSame(['userId' => $_SESSION['userId']], $data[2]);

        unset($_SESSION['userId']);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function cancelTest()
    {
        setParameters(['auctionId' => 42]);
        $_SESSION['userId'] = 42;
        $auction = new AuctionModel();
        $auction->setSellerId(5);

        $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['selectAuctionByAuctionId']);
        $auctionBoMock->method('selectAuctionByAuctionId')->willReturn($auction);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
        $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->cancel();

        $this->assertSame('redirect', $data[0]);
        $this->assertSame('?r=auction/sells', $data[1]);
        $this->assertSame(['userId' => $_SESSION['userId']], $data[2]);

        unset($_SESSION['userId']);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function saveObjectAuctionTest()
    {
        $_SESSION['userId'] = 42;
        setParameters(['name' => 'Casquette', 'description' => 'Magnifique casquette', 'basePrice' => 42, 'reservePrice' => 200, 'duration' => 7, 'privacyId' => 1, 'categoryId' => 1]);

        $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['insertAuction']);
        $auctionBoMock->method('insertAuction')->willReturn(42);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo']);
        $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->saveObjectAuction();

        $this->assertSame('redirect', $data[0]);
        $this->assertSame('?r=home', $data[1]);

        unset($_SESSION['userId']);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function saveObjectAuctionWrongBasePriceTest()
    {
        $values = ['name' => 'Casquette', 'description' => 'Magnifique casquette', 'basePrice' => 202, 'reservePrice' => 200, 'duration' => 7, 'privacyId' => 1, 'categoryId' => 1];
        setParameters($values);

        $categoryList = [new CategoryModel()];

        $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
        $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getCategoryBo']);
        $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->saveObjectAuction();

        $this->assertSame('render', $data[0]);
        $this->assertSame('create', $data[1]);
        $this->assertSame([
            'categoryList' => $categoryList,
            'errors' => ['basePrice' => 'Le prix de base ne peut pas être supérieur au prix de réserve'],
            'values' => $values
        ], $data[2]);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function saveObjectAuctionWrongDurationTest()
    {
        $values = ['name' => 'Casquette', 'description' => 'Magnifique casquette', 'basePrice' => 42, 'reservePrice' => 200, 'duration' => 0, 'privacyId' => 1, 'categoryId' => 1];
        setParameters($values);

        $categoryList = [new CategoryModel()];

        $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
        $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getCategoryBo']);
        $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->saveObjectAuction();

        $this->assertSame('render', $data[0]);
        $this->assertSame('create', $data[1]);
        $this->assertSame([
            'categoryList' => $categoryList,
            'errors' => ['duration' => 'L\'enchère doit durer minimum 24h (soit 1 jour)'],
            'values' => $values
        ], $data[2]);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function saveObjectAuctionFloatBasePriceTest()
    {
        $values = ['name' => 'Casquette', 'description' => 'Magnifique casquette', 'basePrice' => 42.5, 'reservePrice' => 200, 'duration' => 7, 'privacyId' => 1, 'categoryId' => 1];
        setParameters($values);

        $categoryList = [new CategoryModel()];

        $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
        $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getCategoryBo']);
        $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->saveObjectAuction();

        $this->assertSame('render', $data[0]);
        $this->assertSame('create', $data[1]);
        $this->assertSame([
            'categoryList' => $categoryList,
            'errors' => ['basePrice' => 'Le prix de base ne doit pas contenir de virgule'],
            'values' => $values
        ], $data[2]);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function saveObjectAuctionFloatReservePriceTest()
    {
        $values = ['name' => 'Casquette', 'description' => 'Magnifique casquette', 'basePrice' => 42, 'reservePrice' => 200.5, 'duration' => 7, 'privacyId' => 1, 'categoryId' => 1];
        setParameters($values);

        $categoryList = [new CategoryModel()];

        $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
        $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getCategoryBo']);
        $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->saveObjectAuction();

        $this->assertSame('render', $data[0]);
        $this->assertSame('create', $data[1]);
        $this->assertSame([
            'categoryList' => $categoryList,
            'errors' => ['reservePrice' => 'Le prix de réserve ne doit pas contenir de virgule'],
            'values' => $values
        ], $data[2]);
    }

    /**
     * @test
     * @covers AuctionController
     */
    public function saveObjectAuctionIdNullTest()
    {
        $_SESSION['userId'] = 42;
        $categoryList = [new CategoryModel()];
        $values = ['name' => 'Casquette', 'description' => 'Magnifique casquette', 'basePrice' => 42, 'reservePrice' => 200, 'duration' => 7, 'privacyId' => 1, 'categoryId' => 1];
        setParameters($values);

        $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
        $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

        $auctionBoMock = $this->createPartialMock(AuctionBoImpl::class, ['insertAuction']);
        $auctionBoMock->method('insertAuction')->willReturn(null);

        $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getAuctionBo', 'getCategoryBo']);
        $app_BoFactoryMock->method('getAuctionBo')->willReturn($auctionBoMock);
        $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
        App_BoFactory::setFactory($app_BoFactoryMock);

        $auctionController = new AuctionController();
        $data = $auctionController->saveObjectAuction();

        $this->assertSame('render', $data[0]);
        $this->assertSame('create', $data[1]);
        $this->assertSame([
            'categoryList' => $categoryList,
            'errors' => [],
            'values' => $values
        ], $data[2]);

        unset($_SESSION['userId']);
    }
}
