<?php

interface ICategoryDao
{
  public function selectAllCategories() : array;

  public function insertCategory(CategoryModel $categoryModel) : bool;
}
