<?php

namespace Rithis\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Rithis\StoreBundle\Form\Type\OrderType;
use Rithis\StoreBundle\Cart\CartInterface;
use Rithis\StoreBundle\Entity\Order;
use Rithis\StoreBundle\Entity\Position;

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

    public function postCartAction(Request $request)
    {
        $cart = $this->get('rithis.store.cart');
        $em = $this->getDoctrine()->getEntityManager();

        $positions = $this->prepareOrder($request->request->get('order'), $cart);

        $orderEntity = new Order();

        $this->getUser()->addOrder($orderEntity);

        $em->persist($orderEntity);
        $em->flush($orderEntity);

        foreach ($positions as $position) {
            $product = $em->merge($position['product']);

            $positionEntity = new Position();
            $positionEntity->setProduct($product);
            $positionEntity->setCount($position['count']);
            $positionEntity->setPrice($product->getPrice());

            $orderEntity->addPosition($positionEntity);

            $em->persist($positionEntity);
        }

        $em->flush();

        $cart->erase();

        return $this->redirect($this->generateUrl('rithis_store_get_cart'));
    }

    public function patchCartAction(Request $request)
    {
        $cart = $this->get('rithis.store.cart');

        $positions = $this->prepareOrder($request->request->get('order'), $cart);

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

    private function prepareOrder($order, CartInterface $cart)
    {
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

        return $positions;
    }
}
