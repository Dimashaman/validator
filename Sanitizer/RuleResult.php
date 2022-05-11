<?php

namespace Dima\Sanitizer;

class RuleResult
{
    public bool $hasError = false;
    public mixed $normalizedValue = null;
    public string $errorMessage;

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->hasError ? $this->errorMessage : "no errors";
    }

    /**
     * @return mixed|null
     */
    public function getNormalizedValue(): mixed
    {
        return $this->normalizedValue;
    }

    public function setError(string $message): RuleResult
    {
        $this->hasError = true;
        $this->errorMessage = $message;

        return $this;
    }
}