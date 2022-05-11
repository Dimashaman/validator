<?php

namespace Dima\Sanitizer;

use Dima\Sanitizer\Rule\ArrayStructure;
use Dima\Sanitizer\Rule\RuleInterface;
use InvalidArgumentException;

class Sanitizer
{
    private RuleSet $ruleSet;
    private DataSet $dataSet;

    /**
     * @param RuleInterface[] $rules
     * @param string $json
     */
    public function __construct(array $rules, string $json)
    {
        if (!$rules) {
            throw new InvalidArgumentException('Rules passed to sanitizer is not an array');
        }

        if (!$this->isJson($json)) {
            throw new InvalidArgumentException('Abort. This is not a valid json');
        }

        $this->dataSet = new DataSet($json);
        $this->ruleSet = new RuleSet($rules);
    }

    private function isJson($string): bool
    {
        json_decode($string, true);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function sanitize(): array
    {
        $result = (new ArrayStructure($this->ruleSet->getRules()))->validate($this->dataSet->getData());

        return $result->hasError ? $result->getErrors() : $result->getNormalizedValues();
    }
}
