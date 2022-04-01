<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class FloatType extends AbstractRule
{
    const MESSAGE = 'This input must be a float number';
    const LABELED_MESSAGE = '{label} must be a float number';

    public function validate($value)
    {
        if (floatval($value)) {
            return floatval($value);
        };

        return self::MESSAGE;
    }
}
