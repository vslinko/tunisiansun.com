<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function getCategoryAction($categorySlug)
    {
        $productRepository = $this->getDoctrine()->getRepository('RithisStoreBundle:Product');
        $products = $productRepository->findByCategorySlug($categorySlug);

        if (!$products) {
            throw $this->createNotFoundException();
        }

        $category = $products[0]->getCategory();

        return $this->render('RithisStoreBundle:Categories:getCategory.html.twig', array(
            'category' => $category,
            'products' => $products
        ));
    }
}
