<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    public function getProductAction($slug)
    {
        $product = $this->getDoctrine()->getRepository('RithisStoreBundle:Product')->findOneBySlug($slug);

        if (!$product) {
            throw $this->createNotFoundException();
        }

        return $this->render('RithisStoreBundle:Products:getProduct.html.twig', array('product' => $product));
    }
}
