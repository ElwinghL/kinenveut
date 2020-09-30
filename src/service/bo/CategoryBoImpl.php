<?php

class CategoryBoImpl implements ICategoryBo
{
  public function selectAllCategories(): array
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryList = $categoryDao->selectAllCategories();

    return $categoryList;
  }

  public function insertCategory(CategoryModel $categoryModel): bool
  {
    $categoryDao = App_DaoFactory::getFactory()->getCategoryDao();
    $categoryList = $categoryDao->insertCategory($categoryModel);

    return $categoryList;
  }
}
