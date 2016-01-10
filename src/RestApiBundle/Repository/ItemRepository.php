<?php

namespace RestApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use RestApiBundle\Entity\Item;

class ItemRepository extends EntityRepository
{
    /**
     * @param Item $item
     * @return Item
     */
    public function update(Item $item)
    {
        $item = $this->getEntityManager()->merge($item);
        $this->getEntityManager()->flush($item);
        return $item;
    }

    /**
     * @param Item $item
     * @return Item
     */
    public function add(Item $item)
    {
        $this->getEntityManager()->persist($item);
        $this->getEntityManager()->flush($item);
        return $item;
    }
}
