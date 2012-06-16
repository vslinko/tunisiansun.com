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

    public function getProductsAction()
    {
        $productRepository = $this->getDoctrine()->getRepository('RithisStoreBundle:Product');
        $products = $productRepository->findAll();

        if (!$products) {
            throw $this->createNotFoundException();
        }

        return $this->render('RithisStoreBundle:Products:getProducts.html.twig', array(
            'products' => $products,
        ));
    }
}
