<?php

namespace RestApiBundle\Transformer;

use RestApiBundle\Entity\Item;
use RestApiBundle\Exceptions\ApiTransformationException;

class ItemTransformer
{
    /**
     * @param string $rawItem
     * @param null $id
     * @return Item
     * @throws ApiTransformationException
     */
    public function transform($rawItem, $id = null)
    {
        $item = new Item();
        $item->setId($id);

        foreach (json_decode($rawItem) as $key => $value) {
            $setter = 'set'.ucfirst($key);
            if (!method_exists($item, $setter)) {
                throw new ApiTransformationException();
            }
            $item->$setter($value);
        }
        return $item;
    }
}
