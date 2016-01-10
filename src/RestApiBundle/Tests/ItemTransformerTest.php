<?php

namespace RestApiBundle\Tests;

use RestApiBundle\Exceptions\ApiTransformationException;
use RestApiBundle\Transformer\ItemTransformer;

class ItemTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformWithoutId()
    {
        $transformer = new ItemTransformer();
        $rawItem = '{"name": "name1", "description": "description1", "price":"222"}';
        $item = $transformer->transform($rawItem, null);
        $this->assertSame('name1', $item->getName());
        $this->assertSame('description1', $item->getDescription());
        $this->assertSame('222', $item->getPrice());
        $this->assertNull($item->getId());
    }

    public function testTransformWithId()
    {
        $transformer = new ItemTransformer();
        $rawItem = '{"name": "name1", "description": "description1", "price":"222"}';
        $item = $transformer->transform($rawItem, 1);
        $this->assertSame('name1', $item->getName());
        $this->assertSame('description1', $item->getDescription());
        $this->assertSame('222', $item->getPrice());
        $this->assertSame(1, $item->getId());
    }

    public function testTransformationException()
    {
        $this->setExpectedException(ApiTransformationException::class);
        $transformer = new ItemTransformer();
        $rawItem = '{"name": "name1", "description": "description1", "price1":"222"}';
        $transformer->transform($rawItem, 1);
    }
}
