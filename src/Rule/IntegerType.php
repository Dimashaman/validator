<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class IntegerType extends AbstractRule
{
    protected $message = 'This input must be an integer number';

    public function validate()
    {
        $this->reset();
        
        if ((bool) filter_var($this->value, FILTER_VALIDATE_INT) || (string) $this->value === '0') {
            $this->validatedValue = (int) $this->value;
        } else {
            $this->setError();
        };
        
        return $this;
    }
}
