<?php

namespace Dima\Validation\Rule;

use PHPUnit\Framework\TestCase;
use Dima\Validator\Rule\ArrayStructure;

class ArrayStructureTest extends TestCase
{
    protected function setUp(): void
    {
        $structure = ["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7'], "Fiat" => '2'];

        
        $this->rule = new ArrayStructure($structure);
    }

    public function testValidation()
    {
        $this->assertNotNull($this->rule->assignValue(["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7'], "Fiat" => '2'])->validate()->getValidatedValue());
        $this->assertNull($this->rule->assignValue(["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7'], "Fiat" => '2'])->validate()->getMessage());
        $this->assertNotNull($this->rule->assignValue(["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7', "PORSHE" => '1'], "Fiat" => '2'])->validate()->getMessage());
        $this->assertNull($this->rule->assignValue(["Ford" => '1', "german" => ["BMW" => '11', "AUDI" => '7', "PORSHE" => '1'], "Fiat" => '2'])->validate()->getValidatedValue());
    }
}
