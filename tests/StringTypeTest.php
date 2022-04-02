<?php

namespace Dima\Validation\Rule;

use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\StringType;

class StringTypeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->rule = new StringType();
    }

    public function testValidation()
    {
        $this->assertEquals("40", $this->rule->assignValue("40")->validate()->getValidatedValue());
        $this->assertEquals('abc', $this->rule->assignValue('abc')->validate()->getValidatedValue());
        $this->assertEquals('123abc123', $this->rule->assignValue('123abc123')->validate()->getValidatedValue());
        $this->assertNull($this->rule->assignValue(38)->validate()->getValidatedValue());
        $this->assertNotNull($this->rule->assignValue(38.7)->validate()->getMessage());
    }
}
