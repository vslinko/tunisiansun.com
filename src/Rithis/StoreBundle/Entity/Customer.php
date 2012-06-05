<?php

namespace Rithis\StoreBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Rithis\StoreBundle\Cart\CartInterface;
use Rithis\StoreBundle\Cart\ArrayCart;

class Customer implements UserInterface, \Serializable
{
    private $id;
    private $email;
    private $phone;
    private $name;
    private $password;
    private $salt;
    private $admin;
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

    public function __toString()
    {
        return $this->name;
    }

    public function serialize()
    {
        return serialize(array($this->id, $this->email, $this->phone, $this->name, $this->password, $this->salt,
            $this->admin, $this->orders));
    }

    public function unserialize($serialized)
    {
        list($this->id, $this->email, $this->phone, $this->name, $this->password, $this->salt, $this->admin,
            $this->orders) = unserialize($serialized);
    }
}
