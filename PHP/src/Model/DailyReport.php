<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 29/09/2016
 * Time: 21:19
 */

namespace App\Model;
use App\Model\Customer;

class DailyReport
{
    private $id;

    private $postedAt;

    private $habit1Done;

    private $habit2Done;

    private $habit3Done;

    private $weight;

    private $calories;

    private $extraInformation;

    private $customer;

    public function getId()
    {
        return $this->id;
    }

    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    public function getPostedAt()
    {
        return $this->postedAt;
    }

    public function setHabit1Done($habit1Done)
    {
        $this->habit1Done = $habit1Done;

        return $this;
    }

    public function getHabit1Done()
    {
        return $this->habit1Done;
    }

    public function setHabit2Done($habit2Done)
    {
        $this->habit2Done = $habit2Done;

        return $this;
    }

    public function getHabit2Done()
    {
        return $this->habit2Done;
    }


    public function setHabit3Done($habit3Done)
    {
        $this->habit3Done = $habit3Done;

        return $this;
    }


    public function getHabit3Done()
    {
        return $this->habit3Done;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setCalories($calories)
    {
        $this->calories = $calories;

        return $this;
    }

    public function getCalories()
    {
        return $this->calories;
    }


    public function setExtraInformation($extraInformation)
    {
        $this->extraInformation = $extraInformation;

        return $this;
    }


    public function getExtraInformation()
    {
        return $this->extraInformation;
    }


    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
