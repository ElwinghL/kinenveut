<?php

class CategoryDaoImpl implements ICategoryDao
{
  public function selectAllCategories(): array
  {
    $request = db()->query('SELECT id, name FROM Category');

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
    $request = db()->prepare('INSERT INTO Category(name) VALUES (?)');

    $request->execute([$categoryModel->getName()]);

    return db()->lastInsertId();
  }

  public function deleteCategoryById(int $categoryId): bool
  {
    $request = db()->prepare('DELETE FROM Category WHERE id=?');
    $success = $request->execute([$categoryId]);

    return $success;
  }
}
