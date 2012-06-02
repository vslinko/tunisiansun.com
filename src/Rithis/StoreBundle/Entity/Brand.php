<?php

namespace Rithis\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Brand implements \Serializable
{
    private $id;
    private $name;
    private $slug;
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

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        $product->setBrand($this);
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

    public function serialize()
    {
        return serialize(array($this->id, $this->name, $this->slug, $this->products));
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->name, $this->slug, $this->products) = unserialize($serialized);
    }
}
