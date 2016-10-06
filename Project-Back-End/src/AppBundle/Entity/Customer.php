<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 29/09/2016
 * Time: 11:32
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("customer")
 * @ORM\Entity
 */

class Customer
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $habit1;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $habit2;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $habit3;

    /**
     * @ORM\OneToMany(targetEntity="DailyReport", mappedBy="customer")
     */
    private $dailyReports;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dailyReports = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Customer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Customer
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set habit1
     *
     * @param string $habit1
     *
     * @return Customer
     */
    public function setHabit1($habit1)
    {
        $this->habit1 = $habit1;

        return $this;
    }

    /**
     * Get habit1
     *
     * @return string
     */
    public function getHabit1()
    {
        return $this->habit1;
    }

    /**
     * Set habit2
     *
     * @param string $habit2
     *
     * @return Customer
     */
    public function setHabit2($habit2)
    {
        $this->habit2 = $habit2;

        return $this;
    }

    /**
     * Get habit2
     *
     * @return string
     */
    public function getHabit2()
    {
        return $this->habit2;
    }

    /**
     * Set habit3
     *
     * @param string $habit3
     *
     * @return Customer
     */
    public function setHabit3($habit3)
    {
        $this->habit3 = $habit3;

        return $this;
    }

    /**
     * Get habit3
     *
     * @return string
     */
    public function getHabit3()
    {
        return $this->habit3;
    }

    /**
     * Add dailyReport
     *
     * @param \AppBundle\Entity\DailyReport $dailyReport
     *
     * @return Customer
     */
    public function addDailyReport(\AppBundle\Entity\DailyReport $dailyReport)
    {
        $this->dailyReports[] = $dailyReport;

        return $this;
    }

    /**
     * Remove dailyReport
     *
     * @param \AppBundle\Entity\DailyReport $dailyReport
     */
    public function removeDailyReport(\AppBundle\Entity\DailyReport $dailyReport)
    {
        $this->dailyReports->removeElement($dailyReport);
    }

    /**
     * Get dailyReports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDailyReports()
    {
        return $this->dailyReports;
    }

    function __toString()
    {
        return $this->firstName . "  " . $this->lastName;
    }


}
