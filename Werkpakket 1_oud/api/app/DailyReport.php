<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 9/10/2016
 * Time: 1:54
 */
class DailyReport
{
    private $id;

    private $customer_id;

    private $habit1_done;

    private $habit2_done;

    private $habit3_done;

    private $weight;

    private $calories;

    private $extra_information;


    public function __construct()
    {
    }

    public function getExtraInformation()
    {
        return $this->extra_information;
    }

    public function setExtraInformation($extra_information)
    {
        if($extra_information != null)
        $this->extra_information = $extra_information;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function getHabit1Done()
    {
        return $this->habit1_done;
    }

    public function setHabit1Done($habit1_done)
    {
        if ($habit1_done != null) {
            $this->habit1_done = $habit1_done;
        }


    }

    public function getHabit2Done()
    {
        return $this->habit2_done;
    }

    public function setHabit2Done($habit2_done)
    {
        if ($habit2_done != null) {
            $this->habit2_done = $habit2_done;
        }
    }

    public function getHabit3Done()
    {
        return $this->habit3_done;
    }

    public function setHabit3Done($habit3_done)
    {
        if ($habit3_done != null) {
            $this->habit3_done = $habit3_done;
        }
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        if ($weight != null) {
            $this->weight = $weight;
        }

    }

    public function getCalories()
    {
        return $this->calories;
    }

    public function setCalories($calories)
    {
        if ($calories != null) {
            $this->calories = $calories;
        }
    }


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

}