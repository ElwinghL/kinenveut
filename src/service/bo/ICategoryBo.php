<?php

interface ICategoryBo
{
  public function selectAllCategories(): array;

  public function insertCategory(CategoryModel $categoryModel): ?int;

  public function deleteCategoryById(int $categoryId): bool;

  public function selectCategoryById(int $categoryId): ?CategoryModel;

  public function updateCategory(CategoryModel $categoryModel): ?bool;

  public function addOrUpdateCategory(CategoryModel $categoryModel): int;
}
