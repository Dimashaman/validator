<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class StringType extends AbstractRule
{
    const MESSAGE = 'This input must be an string';
    const LABELED_MESSAGE = '{label} must be an string';

    public function validate($value)
    {
        if(is_scalar($value) || (is_object($value) && method_exists($value, '__toString'))) {
            $this->validatedValue = (string) $value;

            return;
        };

        $this->setError();

        return;
    }
}
