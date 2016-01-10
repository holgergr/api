<?php

namespace RestApiBundle\RequestValidator;

use RestApiBundle\Exceptions\ApiValidationException;

class CartAddValidator
{
    const TYPE_MANDATORY = 'mandatory';
    const TYPE_OPTIONAL = 'optional';

    private $fields = [
        'customer_id' => self::TYPE_MANDATORY,
        'item_id' => self::TYPE_MANDATORY,
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
        return true;
    }
}
