<?php

namespace Rithis\StoreBundle\Cart;

use Rithis\StoreBundle\Entity\Product;

interface CartInterface
{
    function addPosition(Product $product);

    function setPositions(array $positions);

    function getPositions();

    function getProduct($id);

    function getTotalPrice();

    function erase();
}
