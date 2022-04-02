<?php

namespace Dima\Validation\Rule;

use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\FloatType;

class FloatTypeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->rule = new FloatType();
    }

    public function testValidation()
    {
        $this->assertEquals(40.25, $this->rule->assignValue(40.25)->validate()->getValidatedValue());
        $this->assertEquals(null, $this->rule->assignValue('abc')->validate()->getValidatedValue());
        $this->assertEquals(null, $this->rule->assignValue('123abc123')->validate()->getValidatedValue());
        $this->assertNotNull($this->rule->assignValue('123abc123')->validate()->getMessage());
        $this->assertNull($this->rule->assignValue(38)->validate()->getValidatedValue());
        $this->assertNull($this->rule->assignValue(38.2)->validate()->getMessage());
        $this->assertNotNull($this->rule->assignValue(38.7)->validate()->getValidatedValue());
    }
}
