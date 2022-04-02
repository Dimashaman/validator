<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class StringType extends AbstractRule
{
    protected $message = 'This input must be an string';

    public function validate()
    {
        $this->reset();

        if (is_string($this->value)) {
            $this->validatedValue = (string) $this->value;
        } else {
            $this->setError();
        }

        return $this;
    }
}
