<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class RussianFederalPhoneNumber extends AbstractRule
{
    protected $message = 'This input must be a correct phone number';
    const LABELED_MESSAGE = '{label} must be an string';

    public function validate()
    {
        if (!is_scalar($this->value)) {
            return $this->message;
        }

        if (preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', (string) $this->value) > 0) {
            $this->validatedValue = '7' . preg_replace('/^(\+|7|8)+|(\D)/', '', $this->value);

            return;
        };

        $this->setError();

        return;
    }
}
