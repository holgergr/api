<?php

namespace RestApiBundle\RequestValidator;

use RestApiBundle\Exceptions\ApiValidationException;

class ItemSaveValidator
{
    const TYPE_MANDATORY = 'mandatory';
    const TYPE_OPTIONAL = 'optional';

    private $fields = [
        'name' => self::TYPE_MANDATORY,
        'description' => self::TYPE_MANDATORY,
        'price' => self::TYPE_MANDATORY,
        'id' => self::TYPE_OPTIONAL,
    ];

    public function validate($rawCart)
    {
        $cartItems = json_decode($rawCart, true);
        foreach ($this->fields as $name => $type) {
            if ($type === self::TYPE_MANDATORY) {
                if (!array_key_exists($name, $cartItems)) {
                    throw new ApiValidationException();
                }
            }
        }
        foreach ($cartItems as $name => $value) {
            if (!array_key_exists($name, $this->fields)) {
                throw new ApiValidationException();
            }
        }
        return true;
    }
}
