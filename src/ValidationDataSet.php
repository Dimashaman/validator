<?php

namespace Dima\Validator;

class ValidationDataSet
{
    private $data = null;

    private $keys = null;
    
    public function __construct($json)
    {
        $this->data = json_decode($json, true);

        $this->keys = array_keys($this->data);
    }

    public function getValueByKey($key) {
        return $this->data[$key];
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the value of keys
     */ 
    public function getKeys()
    {
        return $this->keys;
    }
}
