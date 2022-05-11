<?php

namespace Dima\Sanitizer\Rule;

use Dima\Sanitizer\RuleResult;

class RussianFederalPhoneNumber implements RuleInterface
{
    protected string $message = 'This input must be a correct phone number';

    public function validate($value): RuleResult
    {
        $validationResult = new RuleResult();

        if (!is_scalar($value) || preg_match('/^((8|\+7|7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', (string)$value) > 0) {
            $validationResult->normalizedValue = '7' . preg_replace('/^(\+|7|8)+|(\D)/', '', $value);
        } else {
            $validationResult->setError($this->message);
        }

        return $validationResult;
    }
}
