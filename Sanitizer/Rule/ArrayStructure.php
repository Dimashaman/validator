<?php

namespace Dima\Sanitizer\Rule;

use Dima\Sanitizer\ValidationResult;

class ArrayStructure implements RuleInterface, ArrayRuleInterface
{
    protected string $message = 'This input must have correct structure!';
    private array $rulesMapping;

    public function __construct(array $rulesMapping)
    {
        foreach ($rulesMapping as $key => $rule) {
            if (!$rule instanceof RuleInterface) {
                throw new \Exception("Element '$key' must implement RuleInterface");
            }
        }

        $this->rulesMapping = $rulesMapping;
    }

    public function validate($value): ValidationResult
    {
        $validationResult = new ValidationResult();

        if (!is_array($value)) {
            $validationResult->pushError("self", "Input incorrect, provide Array");

            return $validationResult;
        }

        foreach ($this->rulesMapping as $key => $rule) {
            if (!array_key_exists($key, $value)) {
                $validationResult->pushError($key, "Key incorrect");
                continue;
            }

            $ruleResult = $rule->validate($value[$key]);

            if ($rule instanceof ArrayRuleInterface) {
                $validationResult->pushNormalizedValue($key, $ruleResult->getNormalizedValues());
                if ($ruleResult->hasError) $validationResult->pushError($key, $ruleResult->getErrors());
                continue;
            }

            if ($ruleResult->hasError) {
                $validationResult->pushError($key, $ruleResult->getErrorMessage());
            } else {
                $validationResult->pushNormalizedValue($key, $ruleResult->getNormalizedValue());
            }

        }
        return $validationResult;
    }
}
