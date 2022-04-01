<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class RussianFederalPhoneNumber extends AbstractRule
{
    const MESSAGE = 'This input must be a correct phone number';
    const LABELED_MESSAGE = '{label} must be an string';

    public function validate($value)
    {
        if (!is_scalar($value)) {
            return self::MESSAGE;
        }

        if(preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', (string) $value) > 0) {
            return '7' . preg_replace('/^(\+|7|8)+|(\D)/', '', $value);
        };

        return self::MESSAGE;
    }
}

