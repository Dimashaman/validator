<?php

namespace Dima\Validator;

class ValidationResult
{
    public $success = true;
    private $ruleSet = null;

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
