<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    public function getProductAction($categorySlug, $brandSlug, $productSlug)
    {
        $product = $this->getDoctrine()->getRepository('RithisStoreBundle:Product')->findOneBySlug($productSlug);

        if (!$product || $product->getCategory()->getSlug() != $categorySlug || $product->getBrand()->getSlug() != $brandSlug) {
            throw $this->createNotFoundException();
        }

        return $this->render('RithisStoreBundle:Products:getProduct.html.twig', array('product' => $product));
    }
}
