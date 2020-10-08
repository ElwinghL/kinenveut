<?php

class CategoryModel
{
  private $id;
  private $name;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function setId(?int $id): CategoryModel
  {
    $this->id = $id;

    return $this;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(?string $name): CategoryModel
  {
    $this->name = $name;

    return $this;
  }
}
