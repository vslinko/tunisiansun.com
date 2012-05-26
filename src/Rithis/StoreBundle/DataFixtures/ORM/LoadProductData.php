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
        $product = new Product();
        $product->setName('iPhone');
        $product->setSlug('iphone');
        $product->setPrice(199);
        $product->setDescription('Apple iPhone 4S');
        $product->setCategory($manager->merge($this->getReference('category-phones')));
        $product->setBrand($manager->merge($this->getReference('brand-apple')));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Mac mini');
        $product->setSlug('mac-mini');
        $product->setPrice(599);
        $product->setDescription('Mac mini with Lion Server');
        $product->setCategory($manager->merge($this->getReference('category-servers')));
        $product->setBrand($manager->merge($this->getReference('brand-apple')));
        $manager->persist($product);

        $product = new Product();
        $product->setName('System x');
        $product->setSlug('system-x');
        $product->setPrice(1653);
        $product->setDescription('IBM System x3200 M3');
        $product->setCategory($manager->merge($this->getReference('category-servers')));
        $product->setBrand($manager->merge($this->getReference('brand-ibm')));
        $manager->persist($product);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
