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

    public function prepareRules(array $rules, $data)
    {
        $keys = $data->getKeys();
        foreach ($rules as $key => $rule) {
            // $rule = $this->constructRuleByName($ruleName);
            $rule->assignKey($keys[$key]);
            $rule->assignValue($data->getValueByKey($rule->getKey()));
        }

        $this->rules = $rules;
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
