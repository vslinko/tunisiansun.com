<?php

namespace Rithis\StoreBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Rithis\StoreBundle\Cart\CartInterface;

class Customer implements UserInterface
{
    private $id;
    private $email;
    private $phone;
    private $name;
    private $password;
    private $salt;
    private $admin;
    private $cart;
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsername()
    {
        return $this->getName();
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setAdmin($admin)
    {
        $this->admin = (boolean)$admin;
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function setCart(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function addOrder(Order $order)
    {
        $this->orders[] = $order;
        $order->setCustomer($this);
        return $this;
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function getRoles()
    {
        return $this->isAdmin() ? array('ROLE_ADMIN') : array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }
}
