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
   * @covers
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
   * @covers
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
   * @covers
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
}
