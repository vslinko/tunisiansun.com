<?php

namespace Rithis\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rithis\StoreBundle\Entity\Brand;

class LoadBrandData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $apple = new Brand();
        $apple->setName('Apple');
        $manager->persist($apple);
        $this->addReference('brand-apple', $apple);

        $ibm = new Brand();
        $ibm->setName('IBM');
        $manager->persist($ibm);
        $this->addReference('brand-ibm', $ibm);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
