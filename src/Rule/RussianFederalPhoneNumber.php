<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class RussianFederalPhoneNumber extends AbstractRule
{
    protected string $message = 'This input must be a correct phone number';

    public function validate() : AbstractRule
    {
        $this->reset();

        if (!is_scalar($this->value) || preg_match('/^((8|\+7|7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', (string) $this->value) > 0) {
            $this->validatedValue = '7' . preg_replace('/^(\+|7|8)+|(\D)/', '', $this->value);
        } else {
            $this->setError();
        }
        
        return $this;
    }
}
