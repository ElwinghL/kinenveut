<?php

class CategorieController extends Controller
{
  public function index()
  {
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryList = $categoryBo->selectAllCategories();

    $data = [
      'categoryList' => $categoryList
    ];

    $this->render('index', $data);
  }

  public function update_page()
  {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $data = null;
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();

    if ($id !== null) {
      $category = $categoryBo->selectCategoryById($id);
      if ($category !== null) {
        $data = [
          'category' => [
            'id'  => $category->getId(),
            'name'=> $category->getName()
          ]
        ];
      }
    }

    $this->render('update_page', $data);
  }

  public function delete()
  {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();

    if ($id !== null) {
      $categoryBo->deleteCategoryById($id);
    }

    $this->redirect('?r=categorie');
  }

  public function update_data()
  {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name');
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $category = new CategoryModel();

    $category
    ->setId($id)
    ->setName($name);
    $categoryBo->addOrUpdateCategory($category);

    $this->redirect('?r=categorie');
  }
}
