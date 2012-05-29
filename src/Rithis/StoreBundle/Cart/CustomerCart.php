<?php

namespace Rithis\StoreBundle\Cart;

use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use Rithis\StoreBundle\Entity\Product;
use Rithis\StoreBundle\Entity\Customer;

class CustomerCart extends SessionCart
{
    private $customer;
    private $em;
    private $changed = false;

    public function __construct(Customer $customer, EntityManager $em, Session $session)
    {
        parent::__construct($session);

        $this->customer = $customer;
        $this->em = $em;

        if (!$this->customer->getCart() instanceof ArrayCart) {
            $this->eraseCustomer();
        }

        if (count($positions = parent::getPositions()) > 0) {
            $this->eraseCustomer($positions);
        }
    }

    public function __destruct()
    {
        if ($this->changed) {
            $this->em->flush();
        }
    }

    public function setPositions(array $positions)
    {
        $this->eraseCustomer($positions);
        parent::setPositions($positions);
    }

    public function getPositions()
    {
        return $this->customer->getCart()->getPositions();
    }

    public function erase()
    {
        $this->eraseCustomer();
        parent::erase();
    }

    private function eraseCustomer(array $positions = array())
    {
        $cart = new ArrayCart();
        $cart->setPositions($positions);

        $this->customer->setCart($cart);
        $this->changed = true;
    }
}
