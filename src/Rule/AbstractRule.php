<?php
declare(strict_types=1);
namespace Dima\Validator\Rule;

abstract class AbstractRule
{
    protected $message;
    protected $error = false;
    protected $value = null;
    protected $options = null;
    protected $validatedValue = null;

    protected $key = null;
    protected $success = false;

    abstract public function validate();

    public function __construct($options = null)
    {
        if ($options) {
            $this->options = $options;
        }
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getMessage()
    {
        if ($this->error) {
            return $this->message;
        }

        return null;
    }

    public function getLabeledMessage()
    {
        if ($this->error) {
            return $this->message;
        }

        return null;
    }

    public function getValidatedValue()
    {
        return $this->validatedValue;
    }

    public function hasError() {
        return $this->error;
    }

    protected function setError()
    {
        $this->error = true;

        return $this;
    }

    protected function reset()
    {
        $this->error = false;
        $this->validatedValue = null;

        return $this;
    }

    public function assignValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function assignKey($key)
    {
        $this->key = $key;

        return $this;
    }
}
