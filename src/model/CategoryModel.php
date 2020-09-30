<?php

class CategoryModel
{
  private $id;
  private $name;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id): CategoryModel
  {
    $this->id = $id;

    return $this;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name): CategoryModel
  {
    $this->name = $name;

    return $this;
  }
}
