<?php

namespace Rithis\StoreBundle\Cart;

use Rithis\StoreBundle\Entity\Product;

class ArrayCart implements CartInterface, \Serializable
{
    private $positions = array();

    public function addPosition(Product $product)
    {
        $positions = $this->getPositions();
        $id = $product->getId();

        if (isset($positions[$id])) {
            $positions[$id]['count'] += 1;
        } else {
            $positions[$id] = array(
                'product' => $product,
                'count' => 1,
            );
        }

        $this->setPositions($positions);
    }

    public function setPositions(array $positions)
    {
        $this->positions = $positions;
    }

    public function getPositions()
    {
        return $this->positions;
    }

    public function getProduct($id)
    {
        $positions = $this->getPositions();

        if (isset($positions[$id])) {
            return $positions[$id]['product'];
        }
    }

    public function getTotalPrice()
    {
        $price = 0;
        foreach ($this->getPositions() as $position) {
            $price += $position['product']->getPrice() * $position['count'];
        }

        return $price;
    }

    public function erase()
    {
        $this->positions = array();
    }

    public function serialize()
    {
        return serialize($this->getPositions());
    }

    public function unserialize($serialized)
    {
        $this->setPositions(unserialize($serialized));
    }
}
