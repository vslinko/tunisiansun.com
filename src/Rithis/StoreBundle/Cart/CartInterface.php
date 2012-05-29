<?php

namespace Rithis\StoreBundle\Cart;

use Rithis\StoreBundle\Entity\Product;

interface CartInterface
{
    function addPosition(Product $product);

    function setPositions(array $positions);

    function getPositions();

    function getTotalPrice();

    function erase();
}
