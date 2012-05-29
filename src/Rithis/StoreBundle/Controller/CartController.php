<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Rithis\StoreBundle\Form\Type\OrderType;

class CartController extends Controller
{
    public function getCartAction()
    {
        $cart = $this->get('rithis.store.cart');
        $form = $this->createForm(new OrderType(), $cart);

        return $this->render('RithisStoreBundle:Cart:getCartProducts.html.twig', array(
            'cart' => $cart,
            'form' => $form->createView(),
        ));
    }

    public function postCartAction()
    {

    }

    public function patchCartAction(Request $request)
    {
        $order = $request->request->get('order');
        $cart = $this->get('rithis.store.cart');
        $positions = array();

        foreach ($order['positions'] as $position) {
            if ($position['count'] <= 0) {
                continue;
            }

            $id = $position['product']['id'];

            $positions[$id] = array(
                'product' => $cart->getProduct($id),
                'count' => $position['count'],
            );
        }

        $cart->setPositions($positions);

        return $this->redirect($this->generateUrl('rithis_store_get_cart'));
    }

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
                return $this->redirect($this->generateUrl('rithis_store_get_cart'));
            }
        }
    }
}
