<?php

class CategoryDaoImpl implements ICategoryDao
{
  public function selectAllCategories(): array
  {
    $request = 'SELECT id, name FROM Category';

    try {
      $query = db()->query($request);
      $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

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
      $query->execute([$categoryModel->getName()]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return db()->lastInsertId();
  }

  public function deleteCategoryById(int $categoryId): bool
  {
    $request = 'DELETE FROM Category WHERE id=?';

    try {
      $query = db()->prepare($request);
      $success = $query->execute([$categoryId]);
    } catch (PDOException $Exception) {
      throw new BDDException($Exception->getMessage(), (int)$Exception->getCode());
    }

    return $success;
  }
}
