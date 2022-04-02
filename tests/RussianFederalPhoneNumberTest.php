<?php

namespace Dima\Validation\Rule;

use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\RussianFederalPhoneNumber;

class RussianFederalPhoneNumberTest extends TestCase
{
    protected function setUp(): void
    {
        $this->rule = new RussianFederalPhoneNumber();
    }

    public function testValidation()
    {
        $this->assertEquals("79502885623", $this->rule->assignValue("8 (950) 288-56-23")->validate()->getValidatedValue());
        $this->assertNotNull($this->rule->assignValue("260557")->validate()->getMessage());
        $this->assertEquals("74242242626", $this->rule->assignValue('+7 4242 24-26-26')->validate()->getValidatedValue());
        $this->assertEquals("74242242626", $this->rule->assignValue('7 4242 24-26-26')->validate()->getValidatedValue());
        $this->assertNull($this->rule->assignValue('1.23')->validate()->getValidatedValue());
        $this->assertNull($this->rule->assignValue('123 world')->validate()->getValidatedValue());
    }
}
