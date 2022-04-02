<?php

namespace Dima\Validator;

use Dima\Validator\Validator;
use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\FloatType;
use Dima\Validator\Rule\StringType;
use Dima\Validator\Rule\IntegerType;
use Dima\Validator\Rule\ArrayStructure;
use Dima\Validator\Rule\RussianFederalPhoneNumber;

class ValidatorTest extends TestCase
{
    protected function setUp(): void
    {
        $structure = ["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7'], "Fiat" => '2'];

        $this->validator = new Validator(
            [new IntegerType(), new StringType(), new RussianFederalPhoneNumber(), new FloatType(), new ArrayStructure($structure)],
            '{"foo": "123", "bar": "asd", "baz": "8 (950) 288-56-23", "floatTypeField": "asda123123.212asdas", "cars": {"Ford": 11, "german": {"BMW": 10, "AUDI": 6}, "Fiat": 2}}'
        );
    }

    public function testItWorks()
    {
        $array = [
                "foo" => 123,
                "bar" => "asd",
                "baz" => "79502885623",
                "floatTypeField" => "This input must be a float number",
                "cars" => [
                            "Ford" => 11,
                            "german" => [
                                "BMW" => 10,
                                "AUDI" => 6,
                            ],
                            "Fiat" => 2
                ]

        ];

        $this->assertEquals($array, $this->validator->validate());
    }
}
