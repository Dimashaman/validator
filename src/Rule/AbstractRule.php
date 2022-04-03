<?php
declare(strict_types=1);
namespace Dima\Validator\Rule;

use Dima\Validator\ValidationResult;

abstract class AbstractRule
{
    protected string $message;
    protected bool $error = false;
    protected mixed $value = null;
    protected mixed $options = null;
    protected mixed $validatedValue = null;

    protected ?string $key = null;
    protected bool $success = false;

    abstract public function validate() : AbstractRule;

    public function __construct(mixed $options = null)
    {
        if ($options) {
            $this->options = $options;
        }
    }

    public function getKey() : ?string
    {
        return $this->key;
    }

    public function getMessage() : ?string
    {
        if ($this->error) {
            return $this->message;
        }

        return null;
    }

    public function getLabeledMessage() : ?string
    {
        if ($this->error) {
            return $this->message;
        }

        return null;
    }

    public function getValidatedValue() : mixed
    {
        return $this->validatedValue;
    }

    public function hasError() : bool
    {
        return $this->error;
    }

    protected function setError() : AbstractRule
    {
        $this->error = true;

        return $this;
    }

    protected function reset() : AbstractRule
    {
        $this->error = false;
        $this->validatedValue = null;

        return $this;
    }

    public function assignValue(mixed $value) : AbstractRule
    {
        $this->value = $value;

        return $this;
    }

    public function assignKey(string $key) : AbstractRule
    {
        $this->key = $key;

        return $this;
    }
}
