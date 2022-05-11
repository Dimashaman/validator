<?php

namespace Dima\Sanitizer\Rule;

use Dima\Sanitizer\RuleResult;

class FloatType implements RuleInterface
{
    protected string $message = 'This input must be a float number';

    public function validate($value): RuleResult
    {
        $validationResult = new RuleResult();

        if (is_float($value)) {
            $validationResult->normalizedValue = floatval($value);
        } else {
            $validationResult->setError($this->message);
        }

        return $validationResult;
    }
}
