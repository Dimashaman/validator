<?php

namespace Dima\Validator;

use Dima\Validator\RuleSet;

class ValidationResult
{
    public bool $success = true;
    private RuleSet $ruleSet;

    public function __construct($ruleSet)
    {
        $this->ruleSet = $ruleSet;
        foreach ($this->ruleSet->rules as $validationRule) {
            if (!is_null($validationRule->getMessage())) {
                $this->success = false;
                break;
            }
        }
    }

    public function getAssoc()
    {
        $resultAssoc = [];
        foreach ($this->ruleSet->rules as $validationRule) {
            $resultAssoc[$validationRule->getKey()] = $validationRule->getMessage() ?? $validationRule->getValidatedValue();
        }

        return $resultAssoc;
    }
}
