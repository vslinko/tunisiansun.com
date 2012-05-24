<?php

namespace Rithis\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rithis\StoreBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $phones = new Category();
        $phones->setName('phones');
        $manager->persist($phones);
        $this->addReference('category-phones', $phones);

        $servers = new Category();
        $servers->setName('servers');
        $manager->persist($servers);
        $this->addReference('category-servers', $servers);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
