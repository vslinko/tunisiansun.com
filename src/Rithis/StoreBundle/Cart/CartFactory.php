<?php

namespace Rithis\StoreBundle\Cart;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use Rithis\StoreBundle\Entity\Customer;

class CartFactory
{
    public static function factory(SecurityContext $context, EntityManager $em, Session $session)
    {
        if ($context->getToken() !== null && $context->getToken()->getUser() instanceof Customer) {
            return new CustomerCart($context->getToken()->getUser(), $em, $session);
        } else {
            return new SessionCart($session);
        }
    }
}
