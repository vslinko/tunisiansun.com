<?php

namespace Rithis\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Product implements \Serializable
{
    private $id;
    private $name;
    private $slug;
    private $price;
    private $description;
    private $photo;
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

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
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

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getPhoto()
    {
        return $this->photo;
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

    public function serialize()
    {
        return serialize(array($this->id, $this->name, $this->slug, $this->price, $this->description, $this->photo,
            $this->category, $this->brand));
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->name, $this->slug, $this->price, $this->description, $this->photo, $this->category,
            $this->brand) = unserialize($serialized);
    }
}
