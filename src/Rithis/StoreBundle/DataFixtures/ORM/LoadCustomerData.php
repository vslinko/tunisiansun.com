<?php

namespace Rithis\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rithis\StoreBundle\Entity\Customer;

class LoadCustomerData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $customer = new Customer();
        $customer->setName('vslinko');
        $customer->setEmail('vyacheslav.slinko@gmail.com');
        $customer->setPhone(79852391169);
        $customer->setPassword('12345Wq');
        $customer->setSalt(md5(microtime()));
        $customer->setAdmin(true);

        if (null !== $this->container && $this->container->has('security.encoder_factory')) {
            $factory = $this->container->get('security.encoder_factory');
            $encoder = $factory->getEncoder($customer);
            $password = $encoder->encodePassword('12345Wq', $customer->getSalt());
            $customer->setPassword($password);
        }

        $manager->persist($customer);
        $manager->flush();
    }
}
