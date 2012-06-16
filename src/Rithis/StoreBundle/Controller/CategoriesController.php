<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function getCategoryAction($slug)
    {
        $productRepository = $this->getDoctrine()->getRepository('RithisStoreBundle:Product');
        $products = $productRepository->findByCategorySlug($slug);

        if (!$products) {
            throw $this->createNotFoundException();
        }

        $category = $products[0]->getCategory();

        return $this->render('RithisStoreBundle:Categories:getCategory.html.twig', array(
            'category' => $category,
            'products' => $products
        ));
    }

    public function getCategoriesAction()
    {
        $categoryRepository = $this->getDoctrine()->getRepository('RithisStoreBundle:Category');
        $categories = $categoryRepository->findAll();

        if (!$categories) {
            throw $this->createNotFoundException();
        }

        return $this->render('RithisStoreBundle:Categories:getCategories.html.twig', array(
            'categories' => $categories,
        ));
    }
}
