<?php

namespace RestApiBundle\Tests;

use RestApiBundle\Exceptions\ApiTransformationException;
use RestApiBundle\Transformer\CartTransformer;

class CartTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransform()
    {
        $transformer = new CartTransformer();
        $rawItem = '{"customer_id": "1", "item_id": "2"}';
        $cart = $transformer->transform($rawItem);
        $this->assertSame('1', $cart->getCustomerId());
        $this->assertSame('2', $cart->getItemId());
    }

    public function testTransformationException()
    {
        $this->setExpectedException(ApiTransformationException::class);
        $transformer = new CartTransformer();
        $rawItem = '{"customer_id": "1", "item_id1": "2"}';
        $transformer->transform($rawItem);
    }
}
