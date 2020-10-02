<?php

class CategoryDaoImpl implements ICategoryDao
{
  public function selectAllCategories(): array
  {
    $request = db()->query('SELECT id, name FROM Categories');

    $categories = $request->fetchAll(PDO::FETCH_ASSOC);

    $categoryList = [];

    foreach ($categories as $oneCategory) {
      $oneCategoryModel = new CategoryModel();
      $oneCategoryModel
        ->setId($oneCategory['id'])
        ->setName($oneCategory['name']);

      array_push($categoryList, $oneCategoryModel);
    }

    return $categoryList;
  }

  public function insertCategory(CategoryModel $categoryModel): ?int
  {
    $request = db()->prepare('INSERT INTO Categories(name) VALUES (?)');

    $result = $request->execute([$categoryModel->getName()]);

    return $result;
  }

  public function deleteCategoryById(int $categoryId): bool
  {
    $request = db()->prepare('DELETE FROM Categories WHERE id=?');
    $success = $request->execute([$categoryId]);

    return $success;
  }
}
