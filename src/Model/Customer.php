<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 29/09/2016
 * Time: 11:32
 */

namespace App\Model;


class Customer
{
    private $id;


    private $fistName;


    private $lastName;


    private $habit1;


    private $habit2;


    private $habit3;

    private $dailyReports;

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        $this->dailyReports = [];
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFistName()
    {
        return $this->fistName;
    }

    /**
     * @param mixed $fistName
     */
    public function setFistName($fistName)
    {
        $this->fistName = $fistName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getHabit1()
    {
        return $this->habit1;
    }

    /**
     * @param mixed $habit1
     */
    public function setHabit1($habit1)
    {
        $this->habit1 = $habit1;
    }

    /**
     * @return mixed
     */
    public function getHabit2()
    {
        return $this->habit2;
    }

    /**
     * @param mixed $habit2
     */
    public function setHabit2($habit2)
    {
        $this->habit2 = $habit2;
    }

    /**
     * @return mixed
     */
    public function getHabit3()
    {
        return $this->habit3;
    }

    /**
     * @param mixed $habit3
     */
    public function setHabit3($habit3)
    {
        $this->habit3 = $habit3;
    }

    /**
     * @return mixed
     */
    public function getDailyReports()
    {
        return $this->dailyReports;
    }

    /**
     * @param mixed $dailyReports
     */
    public function setDailyReports($dailyReports)
    {
        $this->dailyReports = $dailyReports;
    }


}
