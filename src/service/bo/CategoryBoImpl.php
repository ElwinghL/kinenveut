<?php

class CategoryBoImpl implements ICategoryBo
{
  public function getAllCategories(): array
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryList = $categoryDao->getAllCategories();

    return $categoryList;
  }

  public function insertCategory(CategoryModel $categoryModel): bool
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryList = $categoryDao->insertCategory($categoryModel);

    return $categoryList;
  }
}
