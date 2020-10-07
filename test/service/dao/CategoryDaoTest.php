<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class CategoryDaoTest extends TestCase
{
  /** @before*/
  public function setUp() : void
  {
    parent::setUp();
    App_DaoFactory::setFactory(new App_DaoFactory());
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function insertCategoryTest() : void
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();

    $categoryTest = new CategoryModel();
    $categoryTest->setName('Test');

    $categoryId = $categoryDao->insertCategory($categoryTest);

    $this->assertNotNull($categoryId);
    $this->assertTrue($categoryId > 0);

    $categoryDao->deleteCategoryById($categoryId);
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function deleteCategoryTest() : void
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryTest = new CategoryModel();
    $categoryTest->setName('Test');

    $categoryId = $categoryDao->insertCategory($categoryTest);

    $success = $categoryDao->deleteCategoryById($categoryId);

    $this->assertTrue($success);
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function selectAllCategoriesTest() : void
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryTest = new CategoryModel();
    $categoryTestName = 'Test';
    $categoryTest->setName($categoryTestName);

    $categoryId = $categoryDao->insertCategory($categoryTest);

    $categoriesSelected = $categoryDao->selectAllCategories();

    $this->assertTrue(is_array($categoriesSelected));
    $this->assertNotNull($categoriesSelected[0]->getName());

    $categoryDao->deleteCategoryById($categoryId);
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function selectCategoryByIdTest() : void
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryTest = new CategoryModel();
    $categoryTestName = 'Test';
    $categoryTest->setName($categoryTestName);

    $categoryId = $categoryDao->insertCategory($categoryTest);

    $category = $categoryDao->selectCategoryById($categoryId);

    $this->assertNotNull($category);
    $this->assertSame($categoryTestName, $category->getName());

    $categoryDao->deleteCategoryById($categoryId);
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function updateCategoryTest() : void
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryTest = new CategoryModel();
    $expectedName = 'Edit-Test';
    $categoryTest->setId($categoryDao->insertCategory($categoryTest->setName('Test')));

    $categoryDao->updateCategory($categoryTest->setName($expectedName));
    $category = $categoryDao->selectCategoryById($categoryTest->getId());

    $this->assertNotNull($category);
    $this->assertSame($expectedName, $category->getName());

    $categoryDao->deleteCategoryById($categoryTest->getId());
  }
}
