<?php
declare(strict_types=1);
namespace Dima\Validator\Rule;

abstract class AbstractRule
{
    protected $message;

    protected $success = false;

    abstract public function validate($value);

    public function getMessage()
    {
        if ($this->success) {
            return null;
        }

        return $message;
    }
}
