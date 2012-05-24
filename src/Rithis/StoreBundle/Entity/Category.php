<?php

namespace Rithis\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Category
{
    private $id;
    private $name;
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

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

    public function addProduct(Product $products)
    {
        $this->products[] = $products;
        return $this;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
