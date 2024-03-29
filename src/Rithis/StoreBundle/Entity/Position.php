<?php

namespace Rithis\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Position implements \Serializable
{
    private $order;
    private $product;
    private $count;
    private $price;

    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function __toString()
    {
        return sprintf('%s = %d * %d', $this->product->getName(), $this->price, $this->count);
    }

    public function serialize()
    {
        return serialize(array($this->order, $this->product, $this->count, $this->price));
    }

    public function unserialize($serialized)
    {
        list($this->order, $this->product, $this->count, $this->price) = unserialize($serialized);
    }
}
