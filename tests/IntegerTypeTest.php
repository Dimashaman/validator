<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class IntegerTypeTest extends TestCase
{
    public function testValidation()
    {
        $rule = new IntegerType();

        $this->assertEquals(40, $rule->validate(40)->getNormalizedValue());
        $this->assertEquals(null, $rule->validate('abc')->getNormalizedValue());
        $this->assertEquals(null, $rule->validate('123abc123')->getNormalizedValue());
        $this->assertFalse($rule->validate(38)->hasError);
        $this->assertNotNull($rule->validate(38.7)->getErrorMessage());
    }
}
