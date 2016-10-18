<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 16/10/2016
 * Time: 16:40
 */
class Model
{
    public function toArray()
    {
        $array = get_object_vars($this);
        unset($array['_parent'], $array['_index']);
        array_walk_recursive($array, function (&$property) {
            if (is_object($property) && method_exists($property, 'toArray')) {
                $property = $property->toArray();
            }
        });
        return $array;
    }
    public function toJson()
    {
        $array = $this->toArray();
        return json_encode($array);
    }
}