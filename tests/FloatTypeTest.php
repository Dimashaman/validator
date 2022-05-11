<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class FloatTypeTest extends TestCase
{


    public function testValidation()
    {
        $rule = new FloatType();

        $this->assertEquals(40.25, $rule->validate(40.25)->getNormalizedValue());
        $this->assertEquals(null, $rule->validate('abc')->getNormalizedValue());
        $this->assertEquals(null, $rule->validate('123abc123')->getNormalizedValue());
        $this->assertNotNull($rule->validate('123abc123')->getErrorMessage());
        $this->assertNull($rule->validate(38)->getNormalizedValue());
        $this->assertFalse($rule->validate(38.2)->hasError);
        $this->assertNotNull($rule->validate(38.7)->getNormalizedValue());
    }
}
