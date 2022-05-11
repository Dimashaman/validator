<?php

namespace Dima\Sanitizer;

use Dima\Sanitizer\Rule\RuleInterface;
use Exception;
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

    /**
     * @throws Exception
     */
    public function sanitize(): array
    {
        $result = [];
        $errors = [];

        $compareStructure = array_diff_key($this->dataSet->getData(), $this->ruleSet->getRules());

        if (count($compareStructure)) {
            throw new Exception(sprintf('Abort. Invalid Structure, missing keys: %s', implode(',', $compareStructure)));
        }
        foreach ($this->dataSet->getData() as $key => $value) {
            $validationResult = $this->ruleSet->getByKey($key)->validate($value);

            if ($validationResult->hasError) {
                $errors[$key] = $validationResult->getErrorMessage();
            } else {
                $result[$key] = $validationResult->getNormalizedValue();
            }

        }

        if (count($errors)) {
            $result = null;

            return $errors;
        }

        return $result;
    }

    private function isJson($string): bool
    {
        json_decode($string, true);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
