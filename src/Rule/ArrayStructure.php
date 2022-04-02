<?php

namespace Dima\Validator\Rule;

use Dima\Validator\Rule\AbstractRule;

class ArrayStructure extends AbstractRule
{
    protected $message = 'This input must have correct structure';

    public function validate()
    {
        $array_diff_key_recursive = $this->keyMatch($this->value, $this->options[$this->getKey()]);

        if (empty($array_diff_key_recursive)) {
            $this->validatedValue = $this->value;
        } else {
            $this->setError();
        }

        return;
    }

    /** return an array that contains keys that do not match between $array and $compare, checking recursively.
    * It's bi-directional so it doesn't matter which param is first
    *
    * @param $array an array to compare
    * @param $compare another array
    *
    * @return an array that contains keys that do not match between $array and $compare
    */
    public function keyMatch($array, $compare)
    {
        $output = array();
        foreach ($array as $key=>$value) {
            if (!array_key_exists($key, $compare)) {
                //keys don't match, so add to output array
                $output[$key] = $value;
            } elseif (is_array($value)||is_array($compare[$key])) {
                //there is a sub array to search, and the keys match in the parent array
                $match = $this->keyMatch($value, $compare[$key]);
                if (count($match)>0) {
                    //if $match is empty, then there wasn't actually a match to add to $output
                    $output[$key] = $match;
                }
            }
        }
        //Literally just renaiming $array to $compare and $compare to $array
        // Why? because I copy-pasted the first foreach loop
        $compareCopy = $compare;
        $compare = $array;
        $array = $compareCopy;
        foreach ($array as $key=>$value) {
            if (!array_key_exists($key, $compare)) {
                $output[$key] = $value;
            } elseif (is_array($value)||is_array($compare[$key])) {
                $match = $this->keyMatch($value, $compare[$key]);
                if (count($match)>0) {
                    $output[$key] = $match;
                }
            }
        }
        return $output;
    }
}
