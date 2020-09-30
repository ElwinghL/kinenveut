<?php

interface ICategoryDao
{
  public function getAllCategories() : array;

  public function insertCategory(CategoryModel $categoryModel) : bool;
}
