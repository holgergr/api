<?php

namespace RestApiBundle\Util;

use FOS\RestBundle\Util\Inflector\InflectorInterface;

class DontPluralizeInflector implements InflectorInterface
{
    /**
     * @param string $word
     * @return string
     */
    public function pluralize($word)
    {
        return $word;
    }
}
