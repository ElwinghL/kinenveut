<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class CategoryBoTest extends TestCase
{
  /** @before*/
  protected function setUp() : void
  {
    parent::setUp();
    App_BoFactory::setFactory(new App_BoFactory());
  }

  /**
   * @test
   * @covers CategoryBoImpl
   */
  public function insertCategoryTest() : void
  {
    $expectedCategoryId = 42;
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryMock = $this->createPartialMock(CategoryModel::class, []);
    $categoryDaoImpMock = $this->createPartialMock(CategoryDaoImpl::class, ['insertCategory']);
    $categoryDaoImpMock->method('insertCategory')->willReturn($expectedCategoryId);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getCategoryDao']);
    $app_DaoFactoryMock->method('getCategoryDao')->willReturn($categoryDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $categoryId = $categoryBo->insertCategory($categoryMock);

    $this->assertSame($expectedCategoryId, $categoryId);
  }

  /**
   * @test
   * @covers CategoryBoImpl
   */
  public function deleteCategoryTest() : void
  {
    $expectedSuccess = true;
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryDaoImpMock = $this->createPartialMock(CategoryDaoImpl::class, ['deleteCategoryById']);
    $categoryDaoImpMock->method('deleteCategoryById')->willReturn($expectedSuccess);
    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getCategoryDao']);
    $app_DaoFactoryMock->method('getCategoryDao')->willReturn($categoryDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $success = $categoryBo->deleteCategoryById(42);

    $this->assertSame($expectedSuccess, $success);
  }

  /**
   * @test
   * @covers CategoryBoImpl
   */
  public function selectAllCategories() : void
  {
    $expectedCategory = new CategoryModel();
    $expectedCategory
        ->setId(42)
        ->setName('Test');

    $expectedCategoryList = [$expectedCategory];

    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryDaoImpMock = $this->createPartialMock(CategoryDaoImpl::class, ['selectAllCategories']);
    $categoryDaoImpMock->method('selectAllCategories')->willReturn($expectedCategoryList);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getCategoryDao']);
    $app_DaoFactoryMock->method('getCategoryDao')->willReturn($categoryDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $categoryList = $categoryBo->selectAllCategories();

    $this->assertSame($expectedCategoryList, $categoryList);
  }

  /**
   * @test
   * @covers CategoryBoImpl
   */
  public function selectCategoryByIdTest() : void
  {
    $expectedCategory = new CategoryModel();
    $expectedCategory
        ->setId(42)
        ->setName('Test');

    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryDaoImpMock = $this->createPartialMock(CategoryDaoImpl::class, ['selectCategoryById']);
    $categoryDaoImpMock->method('selectCategoryById')->willReturn($expectedCategory);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getCategoryDao']);
    $app_DaoFactoryMock->method('getCategoryDao')->willReturn($categoryDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $category = $categoryBo->selectCategoryById(42);

    $this->assertSame($expectedCategory, $category);
  }

  /**
   * @test
   * @covers CategoryBoImpl
   */
  public function updateCategoryTest() : void
  {
    $category = new CategoryModel();
    $category
        ->setId(42)
        ->setName('Test');

    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryDaoImpMock = $this->createPartialMock(CategoryDaoImpl::class, ['updateCategory']);
    $categoryDaoImpMock->method('updateCategory')->willReturn(true);

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getCategoryDao']);
    $app_DaoFactoryMock->method('getCategoryDao')->willReturn($categoryDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $this->assertSame(true, $categoryBo->updateCategory($category));
  }

  /**
   * @test
   * @covers CategoryBoImpl
   */
  public function addOrUpdateCategoryTest() : void
  {
    $category = new CategoryModel();
    $category->setName('Test');

    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryDaoImpMock = $this->createPartialMock(CategoryDaoImpl::class, ['insertCategory', 'updateCategory']);
    $categoryDaoImpMock->method('insertCategory')->willReturn(42);
    $categoryDaoImpMock->method('updateCategory')->will($this->onConsecutiveCalls(true, false));

    $app_DaoFactoryMock = $this->createPartialMock(App_DaoFactory::class, ['getCategoryDao']);
    $app_DaoFactoryMock->method('getCategoryDao')->willReturn($categoryDaoImpMock);
    App_DaoFactory::setFactory($app_DaoFactoryMock);

    $this->assertSame(42, $categoryBo->addOrUpdateCategory($category));

    $category->setId(42);
    $this->assertSame(42, $categoryBo->addOrUpdateCategory($category));
    $this->assertSame(-1, $categoryBo->addOrUpdateCategory($category));
  }
}
