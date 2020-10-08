<?php

class CategorieController extends Controller
{
  public function index(): array
  {
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryList = $categoryBo->selectAllCategories();

    $data = [
      'categoryList' => $categoryList
    ];

    return ['render', 'index', $data];
  }

  public function update_page(): array
  {
    $data = null;

    if (isset(parameters()['id'])) {
      $id = filter_var(parameters()['id'], FILTER_VALIDATE_INT);

      if ($id !== null) {
        $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
        $category = $categoryBo->selectCategoryById($id);

        if ($category !== null) {
          $data = [
            'category' => [
              'id'   => $category->getId(),
              'name' => $category->getName()
            ]
          ];
        }
      }
    }

    return ['render', 'update_page', $data];
  }

  public function delete(): array
  {
    $id = filter_var(parameters()['id'], FILTER_VALIDATE_INT);
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();

    if ($id !== null) {
      $categoryBo->deleteCategoryById($id);
    }

    return ['redirect', '?r=categorie'];
  }

  public function update_data(): array
  {
    $id = filter_var(parameters()['id'], FILTER_VALIDATE_INT);
    $name = filter_var(parameters()['name']);
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $category = new CategoryModel();

    $category
      ->setId($id)
      ->setName($name);
    $categoryBo->addOrUpdateCategory($category);

    return ['redirect', '?r=categorie'];
  }
}
