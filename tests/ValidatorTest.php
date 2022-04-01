<?php

namespace Dima\Validator;

use Dima\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    protected function setUp(): void
    {
        $this->validator = new Validator(
            ['IntegerType', "StringType", 'RussianFederalPhoneNumber', 'FloatType', 'ArraySameType',],
            '{"foo": "123aaa", "bar": "asd", "baz": "260557", "float": "asda123123.212asdas",
                 "sametype": ["1", "true", "null", "false", "false", "false", "true", "null", "2", "3", "hi", "2"]}'
        );

        // $this->validator = new Validator(
        //     ['Integer', 'String', 'RussianFederalNumber', ],
        //     '{"foo": "123", "bar": "asd", "baz": "8 (950) 288-56-23"}'
        // );
    }

    public function testItWorks()
    {
        // var_dump($this->validator);
        $this->validator->validate();
    }

}
