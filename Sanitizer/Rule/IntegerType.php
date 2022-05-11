<?php

namespace Dima\Sanitizer\Rule;

use Dima\Sanitizer\RuleResult;

class IntegerType implements RuleInterface
{
    protected string $message = 'This input must be an integer number';

    public function validate($value): RuleResult
    {
        $validationResult = new RuleResult();

        if (filter_var($value, FILTER_VALIDATE_INT) || (string)$value === '0') {
            $validationResult->normalizedValue = (int)$value;
        } else {
            $validationResult->setError($this->message);
        }

        return $validationResult;
    }
}
