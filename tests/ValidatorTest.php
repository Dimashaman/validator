<?php

namespace Dima\Validator;

use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\StringType;
use Dima\Validator\Rule\IntegerType;
use Dima\Validator\Rule\RussianFederalPhoneNumber;

class ValidatorTest extends TestCase
{
    public function testExampleOne()
    {
        $rules = [
            "foo" => new IntegerType(),
            "bar" => new StringType(),
            "baz" => new RussianFederalPhoneNumber()
        ];

        $json = '{"foo": "123", "bar": "asd", "baz": "8 (950) 288-56-23"}';

        $validator = new Validator($rules, $json);

        $expectedResult = [
            "foo" => 123,
            "bar" => "asd",
            "baz" => "79502885623",
        ];

        $this->assertEquals($expectedResult, $validator->validate());
    }

    public function testExamplesTwoThree()
    {
        $rules = [
            "foo" => new IntegerType(),
            "bar" => new RussianFederalPhoneNumber(),
        ];

        $json = '{"foo": "123абв", "bar": "260557"}';

        $validator = new Validator($rules, $json);

        $expectedResult = [
            "foo" => 'This input must be an integer number',
            "bar" => 'This input must be a correct phone number',
        ];

        $this->assertEquals($expectedResult, $validator->validate());
    }
}
