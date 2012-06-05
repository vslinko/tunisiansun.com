<?php

namespace Rithis\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Order implements \Serializable
{
    private $id;
    private $positions;
    private $customer;

    public function __construct()
    {
        $this->positions = new ArrayCollection();
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

    public function addPosition(Position $position)
    {
        $this->positions[] = $position;
        $position->setOrder($this);
        return $this;
    }

    public function getPositions()
    {
        return $this->positions;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getPrice()
    {
        $price = 0;

        foreach ($this->positions as $position) {
            $price += $position->getPrice() * $position->getCount();
        }

        return $price;
    }

    public function __toString()
    {
        return sprintf('Order #%d', $this->id);
    }

    public function serialize()
    {
        return serialize(array($this->id, $this->positions, $this->customer));
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->positions, $this->customer) = unserialize($serialized);
    }
}
