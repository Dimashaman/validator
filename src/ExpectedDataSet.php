<?php

namespace Dima\Validator;

class ExpectedDataSet
{
    private $validationRules;

    public function __construct(Array $validationRules=array())
    {
        $this->validationRules = $validationRules;

        
        $this->registerRules();
        // foreach($validationRules as $validationRule){
        //     $this->{$key} = $value;
        //   }
    }
}