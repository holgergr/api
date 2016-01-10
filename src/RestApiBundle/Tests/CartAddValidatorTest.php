<?php

namespace RestApiBundle\Tests\Unit;

use RestApiBundle\Exceptions\ApiValidationException;
use RestApiBundle\RequestValidator\CartAddValidator;

class CartAddValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $validator = new CartAddValidator();
        $rawCart = '{"customer_id": 1, "item_id": "2"}';
        $this->assertTrue($validator->validate($rawCart));
    }

    public function testValidateException()
    {
        $this->setExpectedException(ApiValidationException::class);
        $validator = new CartAddValidator();
        $rawCart = '{"customer_id": 1, "item_id1": "2"}';
        $validator->validate($rawCart);
    }
}
