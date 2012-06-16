<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function getProductsAction(Request $request)
    {
        $productRepository = $this->getDoctrine()->getRepository('RithisStoreBundle:Product');

        $query = $request->query->get('query');

        if ($query) {
            $products = $productRepository->findByQuery($query);
        } else {
            $products = $productRepository->findAll();
        }

        return $this->render('RithisStoreBundle:Products:getProducts.html.twig', array(
            'products' => $products,
            'query' => $query,
        ));
    }

    public function getTopProductsAction()
    {
        $productRepository = $this->getDoctrine()->getRepository('RithisStoreBundle:Product');

        $products = $productRepository->findTop();

        return $this->render('RithisStoreBundle:Products:getTopProducts.html.twig', array(
            'products' => $products,
        ));
    }
}
