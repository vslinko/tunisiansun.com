<?php

namespace Rithis\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findByCategorySlug($categorySlug)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p', 'c', 'b');
        $qb->from('RithisStoreBundle:Product', 'p');
        $qb->join('p.category', 'c');
        $qb->join('p.brand', 'b');
        $qb->where($qb->expr()->eq('c.slug', '?0'));
        $qb->setParameters(array($categorySlug));

        return $qb->getQuery()->getResult();
    }

    public function findByCategorySlugAndBrandSlug($categorySlug, $brandSlug)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p', 'c', 'b');
        $qb->from('RithisStoreBundle:Product', 'p');
        $qb->join('p.category', 'c');
        $qb->join('p.brand', 'b');
        $qb->where($qb->expr()->andX(
            $qb->expr()->eq('c.slug', '?0'),
            $qb->expr()->eq('b.slug', '?1')
        ));
        $qb->setParameters(array($categorySlug, $brandSlug));

        return $qb->getQuery()->getResult();
    }
}