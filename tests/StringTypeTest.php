<?php

namespace Dima\Validation\Rule;

use PHPUnit\Framework\TestCase;
use Dima\Sanitizer\Rule\StringType;

class StringTypeTest extends TestCase
{
    public function testValidation()
    {
        $rule = new StringType();

        $this->assertEquals("40", $rule->validate("40")->getNormalizedValue());
        $this->assertEquals('abc', $rule->validate('abc')->getNormalizedValue());
        $this->assertEquals('123abc123', $rule->validate('123abc123')->getNormalizedValue());
        $this->assertNull($rule->validate(38)->getNormalizedValue());
        $this->assertNotNull($rule->validate(38.7)->getErrorMessage());
    }
}
