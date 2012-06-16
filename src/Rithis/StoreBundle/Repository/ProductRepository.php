<?php

namespace Rithis\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findByCategorySlug($slug)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p', 'c', 'b');
        $qb->from('RithisStoreBundle:Product', 'p');
        $qb->join('p.category', 'c');
        $qb->join('p.brand', 'b');
        $qb->where($qb->expr()->eq('c.slug', '?0'));
        $qb->setParameters(array($slug));

        return $qb->getQuery()->getResult();
    }

    public function findByBrandSlug($slug)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p', 'c', 'b');
        $qb->from('RithisStoreBundle:Product', 'p');
        $qb->join('p.category', 'c');
        $qb->join('p.brand', 'b');
        $qb->where($qb->expr()->eq('b.slug', '?0'));
        $qb->setParameters(array($slug));

        return $qb->getQuery()->getResult();
    }
}
