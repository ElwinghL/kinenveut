<?php

class CategorieController extends Controller
{
  public function index()
  {
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryList = $categoryBo->selectAllCategories();

    $data = [
      'categoryList'=> $categoryList
    ];

    $this->render('index', $data);
  }
}
