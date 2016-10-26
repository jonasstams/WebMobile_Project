<?php
class Customer
{
    private $id;


    private $first_name;

    private $last_name;

    private $habit1;

    private $habit2;

    private $habit3;



    public function __construct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    public function getHabit1()
    {
        return $this->habit1;
    }

    public function setHabit1($habit1)
    {
        $this->habit1 = $habit1;
    }

    public function getHabit2()
    {
        return $this->habit2;
    }

    public function setHabit2($habit2)
    {
        $this->habit2 = $habit2;
    }

    public function getHabit3()
    {
        return $this->habit3;
    }

    public function setHabit3($habit3)
    {
        $this->habit3 = $habit3;
    }

    public function getDailyReports()
    {
        return $this->dailyReports;
    }

    public function setDailyReports($dailyReports)
    {
        $this->dailyReports = $dailyReports;
    }

    public function getHabits()
    {
        $array = array('habit1' => $this->habit1, 'habit2' => $this->habit2, 'habit3' => $this->habit3);
        return $array;
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
    }}