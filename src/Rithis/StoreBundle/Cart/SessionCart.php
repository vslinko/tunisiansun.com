<?php

namespace Rithis\StoreBundle\Cart;

use Symfony\Component\HttpFoundation\Session\Session;
use Rithis\StoreBundle\Entity\Product;

class SessionCart extends ArrayCart
{
    private $session;
    private $key;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->key = '_rithis_store_cart';
    }

    public function setPositions(array $positions)
    {
        $this->session->set($this->key, $positions);
    }

    public function getPositions()
    {
        return $this->session->get($this->key, array());
    }

    public function erase()
    {
        $this->session->set($this->key, array());
    }
}
