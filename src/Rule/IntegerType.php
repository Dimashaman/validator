<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class IntegerType extends AbstractRule
{
    const MESSAGE = 'This input must be an integer number';
    const LABELED_MESSAGE = '{label} must be an integer number';

    public function validate($value)
    {
        if((bool) filter_var($value, FILTER_VALIDATE_INT) || (string) $value === '0') {
            return (int) $value;
        };

        return self::MESSAGE;
    }
}