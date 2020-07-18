<?php

namespace App\Utils;

class DataManipulation
{
    /**
     * @param $classDTO
     * @param $array
     * @return array
     */
    public static function arrayMap($classDTO,$array)
    {
        return array_map(function($data) use ($classDTO){
           return new $classDTO($data);
        },$array);
    }
}
