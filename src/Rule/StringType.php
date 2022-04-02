<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class StringType extends AbstractRule
{
    protected $message = 'This input must be an string';
    const LABELED_MESSAGE = '{label} must be an string';

    public function validate()
    {
        if(is_scalar($this->value) || (is_object($this->value) && method_exists($this->value, '__toString'))) {
            $this->validatedValue = (string) $this->value;

            return;
        };

        $this->setError();

        return;
    }
}
