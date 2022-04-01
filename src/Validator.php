<?php

namespace Dima\Validator;

use InvalidArgumentException;

class Validator
{
    public function __construct(array $rules = [], string $json)
    {
        if (! is_array($rules)) {
            throw new \InvalidArgumentException('Data passed to validator is not an array');
        }

        if (!$this->isJson($json)) {
            throw new \InvalidArgumentException('Abort. This is not a valid json');
        }

        $this->ruleSet = new RuleSet();

        $this->dataSet = json_decode($json, true);

        $this->ruleSet->resolveRulesWithKeys($rules, array_keys($this->dataSet));
    }

    public function validate()
    {
        if ($this->dataSet == null) {
            return;
        }

        $result = [];

        foreach ($this->ruleSet->rules as $ruleKey => $ruleValidator) {
            $ruleValidator->assignKey($ruleKey);
            $ruleValidator->validate($this->dataSet[$ruleKey]);
        }

       return $this->ruleSet->createResult();
    }

    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
