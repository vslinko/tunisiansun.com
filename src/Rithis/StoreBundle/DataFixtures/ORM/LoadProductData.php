<?php

namespace Rithis\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rithis\StoreBundle\Entity\Product;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $iphone = new Product();
        $iphone->setName('iPhone');
        $iphone->setPrice(199);
        $iphone->setDescription('Apple iPhone 4S');
        $iphone->setCategory($manager->merge($this->getReference('category-phones')));
        $iphone->setBrand($manager->merge($this->getReference('brand-apple')));
        $manager->persist($iphone);

        $iphone = new Product();
        $iphone->setName('Mac mini');
        $iphone->setPrice(599);
        $iphone->setDescription('Mac mini with Lion Server');
        $iphone->setCategory($manager->merge($this->getReference('category-servers')));
        $iphone->setBrand($manager->merge($this->getReference('brand-apple')));
        $manager->persist($iphone);

        $iphone = new Product();
        $iphone->setName('System x');
        $iphone->setPrice(1653);
        $iphone->setDescription('IBM System x3200 M3');
        $iphone->setCategory($manager->merge($this->getReference('category-servers')));
        $iphone->setBrand($manager->merge($this->getReference('brand-ibm')));
        $manager->persist($iphone);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
