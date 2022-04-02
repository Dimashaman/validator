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
        $structure = [
        "cars" => ["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7'], "Fiat" => '2']
        ];

        $this->validator = new Validator(
            [new IntegerType(), new StringType(), new RussianFederalPhoneNumber(), new FloatType(), new ArrayStructure($structure)],
            '{"foo": "123", "bar": "asd", "baz": "8 (950) 288-56-23", "float": "asda123123.212asdas", "cars": {"Ford": 11, "german": {"BMW": 10, "AUDI": 6}, "Fiat": 2}}'
        );
    }

    public function testItWorks()
    {
        var_dump($this->validator->validate());
    }
}
