<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class ArraySameType extends AbstractRule
{
    protected $message = 'This input must be a same typed array';

    public function validate()
    {
        $this->reset();
        $type = $this->options ? gettype($this->options) : gettype($this->value[0]);

        foreach ($this->value as $element) {
            if (gettype($element) != $type) {
                $this->setError();
                break;
            }
        }

        $this->validatedValue = $this->hasError() ? null : $this->value;
        
        return $this;
    }
}
