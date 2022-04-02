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
}
