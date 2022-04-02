<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class FloatType extends AbstractRule
{
    protected $message = 'This input must be a float number';

    public function validate()
    {
        $this->reset();

        if (is_float($this->value)) {
            $this->validatedValue = floatval($this->value);
        } else {
            $this->setError();
        };

        return $this;
    }
}
