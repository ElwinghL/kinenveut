<?php

class CategorieController extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    $categoryBo = App_BoFactory::getFactory()->getCategoryBo();
    $categoryList = $categoryBo->getAllCategories();

    $data = [
      'categoryList'=> $categoryList
    ];

    $this->render('index', $data);
  }
}
