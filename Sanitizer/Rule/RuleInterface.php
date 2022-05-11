<?php

namespace Dima\Sanitizer\Rule;


use Dima\Sanitizer\RuleResult;

interface RuleInterface
{
    public function validate($value): RuleResult;
}
