<?php

namespace Dima\Sanitizer\Rule;

use Dima\Sanitizer\ValidationResult;
use Exception;

class ArraySameType implements RuleInterface, ArrayRuleInterface
{
    private string $arrayElementsType;

    public function __construct(string $arrayElementsType)
    {
        $this->arrayElementsType = $arrayElementsType;
        if (!class_exists($arrayElementsType)) {
            throw new Exception($arrayElementsType . " Invalid class, provide valid Rule class name");
        }

        if (!in_array(RuleInterface::class, class_implements($arrayElementsType), true)) {
            throw new Exception($arrayElementsType . " doesn't implement RuleInterface");
        }

        if (in_array(ArrayRuleInterface::class, class_implements($arrayElementsType), true)) {
            throw new Exception($arrayElementsType . " ArrayRuleInterface is not supported for now");
        }
    }

    public function validate($value): ValidationResult
    {
        $rule = new $this->arrayElementsType();
        $validationResult = new ValidationResult();

        foreach ($value as $index => $element) {
            $ruleResult = $rule->validate($element);
            if ($ruleResult->hasError) {
                $validationResult->pushError($index, $ruleResult->getErrorMessage());
            } else {
                $validationResult->pushNormalizedValue($index, $ruleResult->getNormalizedValue());
            }
        }

        return $validationResult;
    }
}
