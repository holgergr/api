<?php

namespace RestApiBundle\Tests;

use RestApiBundle\Exceptions\ApiValidationException;
use RestApiBundle\RequestValidator\ItemSaveValidator;

class ItemAddValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $validator = new ItemSaveValidator();
        $result = $validator->validate('{"name": "name1", "description": "description", "price":"222"}');
        $this->assertTrue($result);
    }

    public function testValidateFailureMoreElements()
    {
        $this->setExpectedException(ApiValidationException::class);
        $validator = new ItemSaveValidator();
        $validator->validate(
            '{"name": "name1", "description": "description", "price":"222", "price1":"222"}'
        );
    }

    public function testValidateFailureLessElements()
    {
        $this->setExpectedException(ApiValidationException::class);
        $validator = new ItemSaveValidator();
        $validator->validate(
            '{"name": "name1", "description": "description"}'
        );
    }
}
