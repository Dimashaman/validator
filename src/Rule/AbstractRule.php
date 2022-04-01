<?php
declare(strict_types=1);
namespace Dima\Validator\Rule;

abstract class AbstractRule
{
    protected $message;
    protected $error = false;
    protected $validatedValue = null;

    protected $key = null;
    protected $success = false;

    abstract public function validate($value);

    protected function setError() {
        $this->error = true;
    }

    public function assignKey($key) {
        $this->key = $key;
    }

    public function getKey() {
        return $this->key;
    }

    public function getMessage()
    {
        if ($this->error) {
            return $this->message;
        }

        return null;
    }
}
