<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BrandsController extends Controller
{
    public function getBrandAction($slug)
    {
        $productRepository = $this->getDoctrine()->getRepository('RithisStoreBundle:Product');
        $products = $productRepository->findByBrandSlug($slug);

        if (!$products) {
            throw $this->createNotFoundException();
        }

        $category = $products[0]->getCategory();
        $brand = $products[0]->getBrand();

        return $this->render('RithisStoreBundle:Brands:getBrand.html.twig', array(
            'category' => $category,
            'brand' => $brand,
            'products' => $products
        ));
    }

    public function getBrandsAction()
    {
        $brandRepository = $this->getDoctrine()->getRepository('RithisStoreBundle:Brand');
        $brands = $brandRepository->findAll();

        if (!$brands) {
            throw $this->createNotFoundException();
        }

        return $this->render('RithisStoreBundle:Brands:getBrands.html.twig', array(
            'brands' => $brands,
        ));
    }
}
