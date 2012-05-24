<?php

namespace Rithis\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Product
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $category;
    private $brand;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
