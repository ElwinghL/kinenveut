<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';
include_once 'src/parameters.php';

class CategorieControllerTest extends TestCase
{
  /**
   * @test
   * @covers CategorieController
   */
  public function indexTest()
  {
    $categorieController = new CategorieController();
    $categoryList = [''];

    $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectAllCategories']);
    $categoryBoMock->method('selectAllCategories')->willReturn($categoryList);

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getCategoryBo']);
    $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $categorieController->index();

    $this->assertSame('render', $data[0]);
    $this->assertSame('index', $data[1]);
    $this->assertSame(['categoryList' => $categoryList], $data[2]);
  }

  /**
   * @test
   * @covers CategorieController
   */
  public function updatePageTest()
  {
    global $parameters;
    $parameters = ['id'=>20];
    $categoryController = new CategorieController();

    $expectedId = 20;
    $categorieTest = new CategoryModel();
    $categorieTest
            ->setId($expectedId);

    $categoryBoMock = $this->createPartialMock(CategoryBoImpl::class, ['selectCategoryById']);
    $categoryBoMock->method('selectCategoryById')->will($this->onConsecutiveCalls($categorieTest));

    $app_BoFactoryMock = $this->createPartialMock(App_BoFactory::class, ['getCategoryBo']);
    $app_BoFactoryMock->method('getCategoryBo')->willReturn($categoryBoMock);
    App_BoFactory::setFactory($app_BoFactoryMock);

    $data = $categoryController->update_page();

    $this->assertSame('render', $data[0]);
    $this->assertSame('update_page', $data[1]);
  }

  /**
   * @test
   * @covers CategorieController
   */
  public function updateDataTest()
  {
    $categoryController = new CategorieController();

    $expectedId = 20;
    $expectedName = 'Test';
    $categoryTest = new CategoryModel();
    $categoryTest
            ->setId($expectedId)
            ->setName($expectedName);

    global $parameters;
    $parameters = ['id'=>$expectedId, 'name'=>$expectedName];

    $data = $categoryController->update_data();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=categorie', $data[1]);
  }

  /**
   * @test
   * @covers CategorieController
   */
  public function deleteTest()
  {
    $categorieController = new CategorieController();

    $data = $categorieController->delete();

    $this->assertSame('redirect', $data[0]);
    $this->assertSame('?r=categorie', $data[1]);
  }
}
