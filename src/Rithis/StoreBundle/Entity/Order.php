<?php

namespace Rithis\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Order
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
}
