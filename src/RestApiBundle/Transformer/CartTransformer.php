<?php

namespace RestApiBundle\Transformer;

use Doctrine\Common\Util\Inflector;
use RestApiBundle\Entity\Cart;
use RestApiBundle\Exceptions\ApiTransformationException;

class CartTransformer
{
    /**
     * @param $rawCart
     * @return Cart
     * @throws ApiTransformationException
     */
    public function transform($rawCart)
    {
        $cart = new Cart();
        foreach (json_decode($rawCart) as $key => $value) {
            $setter = 'set'.ucfirst(Inflector::camelize($key));
            if (!method_exists($cart, $setter)) {
                throw new ApiTransformationException();
            }
            $cart->$setter($value);
        }
        return $cart;
    }
}
