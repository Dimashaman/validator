<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class ArrayAssoc extends AbstractRule
{
    const MESSAGE = 'This input must be a same typed array';
    const LABELED_MESSAGE = '{label} must be a same typed array';

    public function validate($value)
    {
        if ($this->array_really_unique($value)) {
            return $value;
        };

        return self::MESSAGE;
    }
}
