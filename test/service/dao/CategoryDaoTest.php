<?php

use PHPUnit\Framework\TestCase;

$dotenv = Dotenv\Dotenv::createImmutable('.');
$dotenv->load();
include_once 'src/db.php';
include_once 'src/tools.php';

class CategoryDaoTest extends TestCase
{
  private $dbTampon;

  const NAME = 'test';

  private $categoryDao;
  private $category;

  public function allFunctionToTest(): array
  {
    return [
      ['insertCategory', 1, new CategoryModel()],
      ['deleteCategoryById', 1, 0],
      ['selectAllCategories', 0, null],
      ['selectCategoryById', 1, 0],
      ['updateCategory', 1, new CategoryModel()]
    ];
  }

  /** @before*/
  public function setUp(): void
  {
    parent::setUp();
    if ($this->dbTampon == null) {
      $this->dbTampon = db();
    }
    App_DaoFactory::setFactory(new App_DaoFactory());
    $this->categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $this->category = new CategoryModel();
    $this->category->setName(self::NAME);
  }

  /** @after */
  public function tearDown() : void
  {
    parent::tearDown();
    setDb($this->dbTampon);
  }

  /**
   * @test
   * @covers CategoryDaoImpl
   * @dataProvider allFunctionToTest
   */
  public function dbTest($function, $nbArg, $arg1): void
  {
    global $db;
    $db = $this->createPartialMock(PDO::class, ['prepare', 'query']);
    $db->method('prepare')->willThrowException(new PDOException());
    $db->method('query')->willThrowException(new PDOException());

    $this->expectException(BDDException::class);

    switch ($nbArg) {
      case 0:
        $this->categoryDao->$function();
        break;
      case 1:
        $this->categoryDao->$function($arg1);
        break;
      default:
        new Exception('nbArg not write');
    }
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

    $this->assertTrue($this->categoryDao->updateCategory($this->category->setName($expectedName)));
    $categorySelected = $this->categoryDao->selectCategoryById($this->category->getId());

    $this->assertNotNull($categorySelected);
    $this->assertSame($expectedName, $categorySelected->getName());

    $this->categoryDao->deleteCategoryById($categorySelected->getId());

    $categoryEmpty = new CategoryModel();
    $this->assertNotNull($this->categoryDao->updateCategory($categoryEmpty));
  }
}
