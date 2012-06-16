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

    public function findByQuery($query)
    {
        // TODO: OPTIMIZE!!!

        $qb = $this->_em->createQueryBuilder();
        $qb->select('p', 'c', 'b');
        $qb->from('RithisStoreBundle:Product', 'p');
        $qb->join('p.category', 'c');
        $qb->join('p.brand', 'b');

        $pieces = explode(' ', $query);
        foreach ($pieces as $i => $piece) {
            foreach (array('p.name', 'p.description', 'b.name') as $property) {
                $qb->orWhere($qb->expr()->like($property, '?' . $i));
            }
            $pieces[$i] = '%' . $piece . '%';
        }

        $qb->setParameters($pieces);

        return $qb->getQuery()->getResult();
    }

    public function findTop($limit = 5)
    {
        $dql = 'SELECT p, pos, SUM(pos.count) AS s FROM RithisStoreBundle:Position pos INNER JOIN pos.product p GROUP BY p ORDER BY s DESC';

        $result = $this->_em->createQuery($dql)
            ->setMaxResults($limit)
            ->getResult();

        $products = array();

        foreach ($result as $row) {
            $products[] = $row[0]->getProduct();
        }

        return $products;
    }
}
