<?php

class CategoryDaoImpl implements ICategoryDao
{
  public function selectAllCategories(): array
  {
    $request = 'SELECT id, name FROM Category';

    $query = db()->query($request);
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);

    $categoryList = [];
    foreach ($categories as $oneCategory) {
      $oneCategoryModel = new CategoryModel();
      $oneCategoryModel
        ->setId($oneCategory['id'])
        ->setName(protectStringToDisplay($oneCategory['name']));

      array_push($categoryList, $oneCategoryModel);
    }

    return $categoryList;
  }

  public function insertCategory(CategoryModel $categoryModel): ?int
  {
    $request = 'INSERT INTO Category(name) VALUES (?)';

    try {
      $query = db()->prepare($request);
      $query->execute([utf8_decode($categoryModel->getName())]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return db()->lastInsertId();
  }

  public function deleteCategoryById(int $categoryId): bool
  {
    $request = 'DELETE FROM Category WHERE id=?';

    $query = db()->prepare($request);

    return $query->execute([$categoryId]);
  }

  public function selectCategoryById(int $categoryId): ?CategoryModel
  {
    $request = 'SELECT id, name FROM Category WHERE id=?';

    $query = db()->prepare($request);
    $query->execute([$categoryId]);
    $category = $query->fetch();

    $categoryModel = null;
    if ($category) {
      $categoryModel = new CategoryModel();
      $categoryModel
        ->setId($category['id'])
        ->setName(protectStringToDisplay($category['name']));
    }

    return $categoryModel;
  }

  public function updateCategory(CategoryModel $categoryModel): ?bool
  {
    $success = null;
    $request = 'UPDATE Category SET name = :name WHERE id = :id';

    try {
      $query = db()->prepare($request);
      $success = $query->execute(['id' => $categoryModel->getId(), 'name' => utf8_decode($categoryModel->getName())]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), $Exception->getCode());
    }

    return $success;
  }
}
