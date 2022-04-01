<?php

namespace Dima\Validator;

use Dima\Validator\Rule\Integer;

class RuleSet
{
    private $rulesClasses = [
        'StringType',
        'IntegerType',
        'FloatType',
        'RussianFederalPhoneNumber',
        'ArraySameType',
        'ArraySameKeys',
    ];

    public $rules = [];

    public function resolveRulesWithKeys(array $ruleNames, array $dataKeys)
    {
        $rules = [];
        
        foreach ($ruleNames as $ruleName) {
            $rules[] = $this->constructRuleByName($ruleName);
        }
        
        $this->rules = array_combine($dataKeys, $rules);
    }

    public function createResult() {
        foreach($this->rules as $validationRule) {
            if($validationRule->
        }
    }
    
    private function constructRuleByName($name)
    {
        if (is_string($name)) {
            $name = trim($name);

            if (class_exists('\\Dima\\Validator\\Rule\\' . $name, true)) {
                $name = 'Dima\\Validator\\Rule\\' . $name;
            }

            if (class_exists($name) && is_subclass_of($name, '\Dima\Validator\Rule\AbstractRule')) {
                $rule = new $name();
            }
        }

        if (!isset($rule)) {
            throw new \InvalidArgumentException(
                sprintf('Impossible to determine the rule based on the name: %s', (string) $name)
            );
        }
        return $rule;
    }
}
