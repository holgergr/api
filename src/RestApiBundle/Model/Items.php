<?php

namespace RestApiBundle\Model;

use Doctrine\ORM\EntityManager;
use RestApiBundle\Entity\Item;
use RestApiBundle\Transformer\ItemTransformer;
use Symfony\Component\HttpFoundation\Response;

class Items
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
     * @param ApiResponse $response
     * @return \RestApiBundle\Entity\Item[]
     */
    public function findAll(ApiResponse $response)
    {
        $items = $this->em->getRepository('RestApiBundle:Item')->findAll();
        $response->setData($items);
        $response->setStatusCode(Response::HTTP_OK);
        return $items;
    }

    /**
     * @param Item $item
     * @param ApiResponse $response
     * @return Item|null
     */
    public function saveItem(Item $item, ApiResponse $response)
    {
        if (null === $item->getId()) {
            $item = $this->em->getRepository('RestApiBundle:Item')->add($item);
            $response->setStatusCode(Response::HTTP_CREATED);
        } else {
            $item = $this->em->getRepository('RestApiBundle:Item')->update($item);
            $response->setStatusCode(Response::HTTP_OK);
        }
        $response->setId($item->getId());
        return $item;
    }

    /**
     * @param string $rawItem
     * @param null $id
     * @return Item
     */
    public function transformToEntity($rawItem, $id = null)
    {
        $transformer = new ItemTransformer();
        return $transformer->transform($rawItem, $id);
    }
}
