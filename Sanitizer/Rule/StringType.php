<?php

namespace Dima\Sanitizer\Rule;

use Dima\Sanitizer\RuleResult;

class StringType implements RuleInterface
{
    protected string $message = 'This input must be a string';

    public function validate($value): RuleResult
    {
        $validationResult = new RuleResult();

        if (is_string($value)) {
            $validationResult->normalizedValue = $value;
        } else {
            $validationResult->setError($this->message);
        }

        return $validationResult;
    }
}
