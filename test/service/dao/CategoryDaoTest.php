<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class CategoryDaoTest extends TestCase
{
  const NAME = 'test';

  private $categoryDao = null;
  private $category = null;

  /** @before*/
  public function setUp(): void
  {
    parent::setUp();
    App_DaoFactory::setFactory(new App_DaoFactory());
    $this->categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $this->category = new CategoryModel();
    $this->category->setName(self::NAME);
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function insertCategoryTest(): void
  {
    $categoryId = $this->categoryDao->insertCategory($this->category);

    $this->assertNotNull($categoryId);
    $this->assertTrue($categoryId > 0);

    $this->categoryDao->deleteCategoryById($categoryId);

    $categoryEmpty = new CategoryModel();
    $categoryId = $this->categoryDao->insertCategory($categoryEmpty);
    $this->assertNotNull($categoryId);
    $this->categoryDao->deleteCategoryById($categoryId);
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function deleteCategoryTest(): void
  {
    $categoryId = $this->categoryDao->insertCategory($this->category);

    $this->assertTrue($this->categoryDao->deleteCategoryById($categoryId));
    $this->assertTrue($this->categoryDao->deleteCategoryById(-1));
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function selectAllCategoriesTest(): void
  {
    $categoryId = $this->categoryDao->insertCategory($this->category);

    $categoriesSelected = $this->categoryDao->selectAllCategories();

    $this->assertTrue(is_array($categoriesSelected));
    $this->assertNotNull($categoriesSelected[0]->getName());

    $this->categoryDao->deleteCategoryById($categoryId);
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function selectCategoryByIdTest(): void
  {
    $categoryId = $this->categoryDao->insertCategory($this->category);

    $categorySelected = $this->categoryDao->selectCategoryById($categoryId);

    $this->assertNotNull($categorySelected);
    $this->assertSame(self::NAME, $categorySelected->getName());

    $this->categoryDao->deleteCategoryById($categoryId);

    $this->assertNull($this->categoryDao->selectCategoryById(-1));
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   */
  public function updateCategoryTest(): void
  {
    $expectedName = 'Edit-Test';
    $this->category->setId($this->categoryDao->insertCategory($this->category));

    $this->categoryDao->updateCategory($this->category->setName($expectedName));
    $categorySelected = $this->categoryDao->selectCategoryById($this->category->getId());

    $this->assertNotNull($categorySelected);
    $this->assertSame($expectedName, $categorySelected->getName());

    $this->categoryDao->deleteCategoryById($categorySelected->getId());

    $categoryEmpty = new CategoryModel();
    $this->assertNotNull($this->categoryDao->updateCategory($categoryEmpty));
  }
}
