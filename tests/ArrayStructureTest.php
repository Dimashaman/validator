<?php

namespace Dima\Sanitizer\Rule;

use PHPUnit\Framework\TestCase;

class ArrayStructureTest extends TestCase
{
    public function testPositiveStructure()
    {
        $rule = new ArrayStructure([
            "firstName" => new StringType(),
            "lastName" => new StringType(),
        ]);

        $result = $rule->validate([
            "firstName" => "Василий",
            "lastName" => "Пупкин"
        ]);

        $this->assertEquals([
            "firstName" => "Василий",
            "lastName" => "Пупкин"
        ], $result->getNormalizedValues());
    }

    public function testPositiveRecursiveStructure()
    {
        $rule = new ArrayStructure([
            "firstName" => new StringType(),
            "lastName" => new StringType(),
            "address" => new ArrayStructure([
                "street" => new StringType(),
                "city" => new StringType(),
            ])
        ]);

        $source = [
            "firstName" => "Василий",
            "lastName" => "Пупкин",
            "address" => [
                "street" => "Kuznecova",
                "city" => "Taipei"
            ]
        ];

        $result = $rule->validate($source);
        var_dump($result->getErrors());
        $this->assertEquals($source, $result->getNormalizedValues());
    }

    public function testNegativeRecursiveStructure()
    {
        $rule = new ArrayStructure([
            "firstName" => new StringType(),
            "lastName" => new StringType(),
            "address" => new ArrayStructure([
                "street" => new StringType(),
                "city" => new StringType(),
            ])
        ]);

        $source = [
            "firstName" => "Василий",
            "lastName" => "Пупкин",
            "address" => 12
        ];

        $errors = ["address" => [
            "self" => "Input incorrect, provide Array"
        ]];

//        $errors = ["address" => ["address isn't a structure"]];

        $result = $rule->validate($source);

        $this->assertEquals($errors, $result->getErrors());
    }

    public function testRecursiveStructureKeyWrongType()
    {
        $rule = new ArrayStructure([
            "firstName" => new StringType(),
            "lastName" => new StringType(),
        ]);

        $result = $rule->validate([
            "firstName" => "Василий",
            "lastName" => 12
        ]);

        $this->assertEquals(null, $result->getNormalizedValues());

        $this->assertEquals(['lastName' => "This input must be a string"], $result->getErrors());
    }

    public function testRecursiveStructureFailKeyDoesntExist()
    {
        $rule = new ArrayStructure([
            "firstName" => new StringType(),
            "lastName" => new StringType(),
        ]);

        $result = $rule->validate([
            "firstName" => "Василий",
            "last" => "Пупкин"
        ]);

        $this->assertNotEquals([
            "firstName" => "Василий",
            "lastName" => "Пупкин"
        ], $result->getNormalizedValues());

        $error = ["lastName" => "Key incorrect"];

        $this->assertEquals($error, $result->getErrors());
    }
}
