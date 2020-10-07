<?php

use PHPUnit\Framework\TestCase;

include_once 'src/tools.php';

class CategoryModelTest extends TestCase
{
  /**
   * @test
   * @covers CategoryModel
  */
  public function getterSetterTest()
  {
    $category = new CategoryModel();
    $id = 1;
    $name = 'Je suis une belle catégorie';

    $category
      ->setId($id)
      ->setName($name);

    $this->assertSame($category->getId(), $id);
    $this->assertSame($category->getName(), $name);
  }
}
