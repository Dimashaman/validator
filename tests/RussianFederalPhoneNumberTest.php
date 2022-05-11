<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class RussianFederalPhoneNumberTest extends TestCase
{
    public function testValidation()
    {
        $rule = new RussianFederalPhoneNumber();

        $this->assertEquals("79502885623", $rule->validate("8 (950) 288-56-23")->getNormalizedValue());
        $this->assertNotNull($rule->validate("260557")->getErrorMessage());
        $this->assertEquals("74242242626", $rule->validate('+7 4242 24-26-26')->getNormalizedValue());
        $this->assertEquals("74242242626", $rule->validate('7 4242 24-26-26')->getNormalizedValue());
        $this->assertNull($rule->validate('1.23')->getNormalizedValue());
        $this->assertNull($rule->validate('123 world')->getNormalizedValue());
    }
}
