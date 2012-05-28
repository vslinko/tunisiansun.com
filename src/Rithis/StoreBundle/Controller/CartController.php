<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function postCartProductsAction(Request $request)
    {
        $id = $request->request->get('id');

        if (!$id) {
            throw $this->createNotFoundException();
        }

        $product = $this->getDoctrine()->getRepository('RithisStoreBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException();
        }

        $cart = $this->get('rithis.store.cart');
        $cart->addPosition($product);

        if ($request->isXmlHttpRequest()) {
            $serialized = $this->get('serializer')->serialize(array(
                'positions' => $cart->getPositions(),
                'totalPrice' => $cart->getTotalPrice(),
            ), 'json');

            return new Response($serialized, 200, array('Content-Type' => 'application/json'));
        } else {
            if ($request->server->has('HTTP_REFERER')) {
                return $this->redirect($request->server->get('HTTP_REFERER'));
            } else {
                return $this->redirect($this->generateUrl('rithis_store_get_cart_products'));
            }
        }
    }

    public function getCartProductsAction()
    {
        return $this->render('RithisStoreBundle:Cart:getCartProducts.html.twig', array(
            'cart' => $this->get('rithis.store.cart'),
        ));
    }
}
