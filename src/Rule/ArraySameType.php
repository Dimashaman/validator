<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class ArraySameType extends AbstractRule
{
    const MESSAGE = 'This input must be a same typed array';
    const LABELED_MESSAGE = '{label} must be a same typed array';

    public function validate($value)
    {
        if ($this->array_really_unique($value)) {
            return $value;
        };

        return self::MESSAGE;
    }

    private function array_really_unique($array)
    {
        foreach ($array as $item) {
            foreach ($array as $item2) {
                var_dump(gettype($item));
                if (gettype($item) != gettype($item2)) {
                    break;
                    return false;
                }
            }
        }
        return true;
    }
}
