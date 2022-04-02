<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class FloatType extends AbstractRule
{
    protected $message = 'This input must be a float number';

    public function validate()
    {
        if (floatval($this->value)) {
            $this->validatedValue = floatval($this->value);

            return;
        };

        $this->setError();

        return;
    }
}
