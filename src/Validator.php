<?php

namespace Dima\Validator;

use Dima\Validator\RuleSet;
use Dima\Validator\ValidationResult;
use Dima\Validator\ValidationDataSet;

class Validator
{
    private RuleSet $ruleSet;
    private ValidationDataSet $dataSet;
    
    public function __construct(array $rules, string $json)
    {
        if (! is_array($rules)) {
            throw new \InvalidArgumentException('Data passed to validator is not an array');
        }

        if (!$this->isJson($json)) {
            throw new \InvalidArgumentException('Abort. This is not a valid json');
        }

        $this->dataSet = new ValidationDataSet($json);
        
        $this->ruleSet = new RuleSet();
        $this->ruleSet->prepareRules($rules, $this->dataSet);
    }

    public function validate()
    {
        if ($this->dataSet == null) {
            return;
        }

        $result = [];

        foreach ($this->ruleSet->rules as $ruleValidator) {
            $ruleValidator->validate();
        }

        $validationResult = new ValidationResult($this->ruleSet);

        return $validationResult->getAssoc();
    }

    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
