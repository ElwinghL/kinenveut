<?php

interface ICategoryBo
{
  public function selectAllCategories() : array;

  public function insertCategory(CategoryModel $categoryModel) : bool;
}
