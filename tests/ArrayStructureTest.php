<?php

namespace Dima\Validation\Rule;

use Dima\Validator\Rule\ArraySameType;
use Dima\Validator\Rule\IntegerType;
use Dima\Validator\Rule\RussianFederalPhoneNumber;
use Dima\Validator\Rule\StringType;
use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\ArrayStructure;

class ArrayStructureTest extends TestCase
{


    public function testValidation()
    {
        $structure = ["foo" => (new StringType()), "bar" => (new IntegerType()), "baz" => (new RussianFederalPhoneNumber())];
        $rule = new ArrayStructure($structure);

        $this->assertNotNull($rule->validate(["foo" => "1", "bar" => 1, "baz" => '+79963433704'])->getValidatedValue());
        $this->assertNotNull($rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066'])->getMessage());
        $this->assertEquals('This input must have correct structure', $rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066'])->getMessage());
//        $this->assertNotNull($rule->validate(["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7', "PORSCHE" => '1'], "Fiat" => '2'])->getMessage());
//        $this->assertNull($rule->validate(["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7', "PORSCHE" => '1'], "Fiat" => '2'])->getValidatedValue());
    }

    public function testComplexStructure()
    {
        $structure = ["foo" => (new StringType()), "bar" => (new IntegerType()), "baz" => (new RussianFederalPhoneNumber()), "biz" => (
        new ArraySameType(new StringType())
        )];
        $rule = new ArrayStructure($structure);

        $this->assertNotNull($rule->validate(["foo" => "1", "bar" => 1, "baz" => '+79963433704', "biz" => ['hello', 'world']])->getValidatedValue());
        $this->assertNotNull($rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066'])->getMessage());
        $this->assertEquals('This input must have correct structure', $rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066'])->getMessage());
        $this->assertEquals('This input must have correct structure', $rule->validate(["foo" => "1", "bar" => "abc", "baz" => '2605066', "biz" => ['hello', 1]])->getMessage());
        $this->assertEquals(["foo" => "1", "bar" => 2, "baz" => '+79963433704', "biz" => ['hello', 'world']], $rule->validate(["foo" => "1", "bar" => 2, "baz" => '+79963433704', "biz" => ['hello', 'world']])->getValidatedValue());
//        $this->assertNotNull($rule->validate(["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7', "PORSCHE" => '1'], "Fiat" => '2'])->getMessage());
//        $this->assertNull($rule->validate(["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7', "PORSCHE" => '1'], "Fiat" => '2'])->getValidatedValue());
    }

    public function testRecursiveStructure()
    {
        $substructure = ['name' => (new StringType()), 'phone' => (new RussianFederalPhoneNumber())];
        $structure = ["id" => (new IntegerType()), "userdata" => (new ArrayStructure($substructure))];

        $rule = new ArrayStructure($structure);

        $this->assertNotNull($rule->validate(["id" => 1, "userdata" => ['name' => 'ivan', "phone" => "+79963433704"]])->getValidatedValue());
        $this->assertNotNull($rule->validate(["id" => 1, "userdata" => ['name' => 44, "phone" => "+79963433704"]])->getMessage());
    }
}
