<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class ArraySameTypeTest extends TestCase
{
    public function testInvalidClassName()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid class, provide valid Rule class name");

        $rule = new ArraySameType('');
    }

    public function testInvalidClass()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("stdClass doesn't implement RuleInterface");

        $rule = new ArraySameType(\stdClass::class);
    }

    public function testProhibitedClass()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Dima\Sanitizer\Rule\ArrayStructure ArrayRuleInterface is not supported for now");

        $rule = new ArraySameType(ArrayStructure::class);
    }

    public function testValid()
    {
        $rule = new ArraySameType(IntegerType::class);
        $source = [1, 2, 3, 4, 5];
        $result = $rule->validate($source);

        $this->assertEquals($source, $result->getNormalizedValues());
    }

    public function testInvalidElement()
    {
        $rule = new ArraySameType(IntegerType::class);
        $source = [1, 2, 3, 4.55, 5];
        $errors = [3 => "This input must be an integer number"];
        $result = $rule->validate($source);

        $this->assertEquals($errors, $result->getErrors());
    }
}
