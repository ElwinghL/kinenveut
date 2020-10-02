<?php

interface ICategoryDao
{
  public function selectAllCategories() : array;

  public function insertCategory(CategoryModel $categoryModel): ?int;

  public function deleteCategoryById(int $categoryId) : bool;
}
