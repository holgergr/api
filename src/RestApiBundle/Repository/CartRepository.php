<?php

namespace RestApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use RestApiBundle\Entity\Cart;

class CartRepository extends EntityRepository
{
    /**
     * @param Cart $cart
     * @return Cart
     */
    public function add(Cart $cart)
    {
        $this->getEntityManager()->persist($cart);
        $this->getEntityManager()->flush($cart);
        return $cart;
    }
}
