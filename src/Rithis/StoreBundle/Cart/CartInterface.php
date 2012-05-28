<?php

namespace Rithis\StoreBundle\Cart;

use Rithis\StoreBundle\Entity\Product;

interface CartInterface
{
    function addPosition(Product $product);

    function getPositions();

    function getTotalPrice();
}
