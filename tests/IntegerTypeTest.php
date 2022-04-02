<?php

namespace Dima\Validation\Rule;

use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\IntegerType;

class IntegerTypeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->rule = new IntegerType();
    }

    public function testValidation()
    {
        $this->assertEquals(40, $this->rule->assignValue(40)->validate()->getValidatedValue());
        $this->assertEquals(null, $this->rule->assignValue('abc')->validate()->getValidatedValue());
        $this->assertEquals(null, $this->rule->assignValue('123abc123')->validate()->getValidatedValue());
        $this->assertNull($this->rule->assignValue(38)->validate()->getMessage());
        $this->assertNotNull($this->rule->assignValue(38.7)->validate()->getMessage());
    }
}
