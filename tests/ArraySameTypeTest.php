<?php

namespace Dima\Validation\Rule;

use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\ArraySameType;

class ArraySameTypeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->rule = new ArraySameType((string) 'string');
    }

    public function testValidation()
    {
        $this->assertEquals(['hello', 'world'], $this->rule->assignValue(['hello', 'world'])->validate()->getValidatedValue());
        $this->assertNull($this->rule->assignValue(['hello', 'world', 1])->validate()->getValidatedValue());
    }
}
