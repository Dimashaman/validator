<?php

namespace Dima\Sanitizer;

class ValidationResult extends RuleResult
{
    public array $errors = [];
    public array $normalizedValues = [];

    /**
     * @return array
     */
    public function getNormalizedValues(): ?array
    {
        return $this->hasError ? null : $this->normalizedValues;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->hasError ? $this->errorMessage : "no errors";
    }

    public function setError(string $message): ValidationResult
    {
        $this->hasError = true;
        $this->errorMessage = $message;

        return $this;
    }

    public function pushError(string $key, mixed $value): void
    {
        $this->hasError = true;
        $this->errors[$key] = $value;
    }

    public function pushNormalizedValue(string $key, mixed $value): void
    {
        $this->normalizedValues[$key] = $value;
    }
}