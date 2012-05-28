<?php

namespace Rithis\StoreBundle\Cart;

use Symfony\Component\HttpFoundation\Session\Session;
use Rithis\StoreBundle\Entity\Product;

class Cart implements CartInterface
{
    private $session;
    private $key;

    public function __construct(Session $session, $key = 'cart')
    {
        $this->session = $session;
        $this->key = '_rithis_store_' . $key;
    }

    public function addPosition(Product $product)
    {
        $products = $this->getPositions();
        $id = $product->getId();

        if (!isset($products[$id])) {
            $products[$id] = array(
                'product' => $product,
                'count' => 1,
            );
        } else {
            $products[$id]['count'] += 1;
        }

        $this->session->set($this->key, $products);
    }

    public function getPositions()
    {
        return $this->session->get($this->key, array());
    }

    public function getTotalPrice()
    {
        $price = 0;
        foreach ($this->getPositions() as $position) {
            $price += $position['product']->getPrice() * $position['count'];
        }

        return $price;
    }
}
