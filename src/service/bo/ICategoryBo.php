<?php

interface ICategoryBo
{
  public function getAllCategories() : array;

  public function insertCategory(CategoryModel $categoryModel) : bool;
}
