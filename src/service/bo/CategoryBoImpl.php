<?php

class CategoryBoImpl implements ICategoryBo
{
  public function selectAllCategories(): array
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryList = $categoryDao->selectAllCategories();

    return $categoryList;
  }

  public function insertCategory(CategoryModel $categoryModel): ?int
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryList = $categoryDao->insertCategory($categoryModel);

    return $categoryList;
  }

  public function deleteCategoryById(int $categoryId): bool
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $success = $categoryDao->deleteCategoryById($categoryId);

    return $success;
  }

  public function selectCategoryById(int $categoryId): ?CategoryModel
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();

    return $categoryDao->selectCategoryById($categoryId);
  }

  public function updateCategory(CategoryModel $categoryModel): ?bool
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();

    return $categoryDao->updateCategory($categoryModel);
  }

  public function addOrUpdateCategory(CategoryModel $categoryModel): int
  {
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();

    $success = null;
    if ($categoryModel->getId() == null) {
      $success = $categoryBo->insertCategory($categoryModel);
    } else {
      $success = $categoryBo->updateCategory($categoryModel);
      $success = $success ? $categoryModel->getId() : -1;
    }

    return $success;
  }
}
