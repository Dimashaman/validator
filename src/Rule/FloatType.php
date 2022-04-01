<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class FloatType extends AbstractRule
{
    protected $message = 'This input must be a float number';

    public function validate($value)
    {
        if (floatval($value)) {
            $this->validatedValue = floatval($value);

            return;
        };

        $this->setError();

        return;
    }
}
