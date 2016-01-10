<?php

namespace RestApiBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class Carts
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Items constructor.
     * @param EntityManager $itemRepository
     */
    public function __construct(EntityManager $itemRepository)
    {
        $this->em = $itemRepository;
    }

    /**
     * @param $cart
     * @param ApiResponse $response
     * @return \RestApiBundle\Entity\Cart
     */
    public function add($cart, ApiResponse $response)
    {
        $cart = $this->em->getRepository('RestApiBundle:Cart')->add($cart);
        $response->setStatusCode(Response::HTTP_OK);
        $response->setId($cart->getItemId());
        $response->addHeader('Location', '/path_to_cart/'.$cart->getItemId());
        return $cart;
    }
}
