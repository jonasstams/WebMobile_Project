<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 29/09/2016
 * Time: 21:19
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("daily_report")
 * @ORM\Entity
 */
class DailyReport
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date", name="posted_at")
     */
    private $postedAt;

    /**
     * @ORM\Column(type="boolean", name="habit1_done")
     */
    private $habit1Done;

    /**
     * @ORM\Column(type="boolean", name="habit2_done")
     */
    private $habit2Done;

    /**
     * @ORM\Column(type="boolean", name="habit3_done")
     */
    private $habit3Done;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $calories;

    /**
     * @ORM\Column(type="string", length=500, name="extra_information")
     */
    private $extraInformation;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="dailyReports")
     */
    private $customer;

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
     * Set postedAt
     *
     * @param \DateTime $postedAt
     *
     * @return DailyReport
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get postedAt
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * Set habit1Done
     *
     * @param boolean $habit1Done
     *
     * @return DailyReport
     */
    public function setHabit1Done($habit1Done)
    {
        $this->habit1Done = $habit1Done;

        return $this;
    }

    /**
     * Get habit1Done
     *
     * @return boolean
     */
    public function getHabit1Done()
    {
        return $this->habit1Done;
    }

    /**
     * Set habit2Done
     *
     * @param boolean $habit2Done
     *
     * @return DailyReport
     */
    public function setHabit2Done($habit2Done)
    {
        $this->habit2Done = $habit2Done;

        return $this;
    }

    /**
     * Get habit2Done
     *
     * @return boolean
     */
    public function getHabit2Done()
    {
        return $this->habit2Done;
    }

    /**
     * Set habit3Done
     *
     * @param boolean $habit3Done
     *
     * @return DailyReport
     */
    public function setHabit3Done($habit3Done)
    {
        $this->habit3Done = $habit3Done;

        return $this;
    }

    /**
     * Get habit3Done
     *
     * @return boolean
     */
    public function getHabit3Done()
    {
        return $this->habit3Done;
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return DailyReport
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set calories
     *
     * @param float $calories
     *
     * @return DailyReport
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;

        return $this;
    }

    /**
     * Get calories
     *
     * @return float
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * Set extraInformation
     *
     * @param string $extraInformation
     *
     * @return DailyReport
     */
    public function setExtraInformation($extraInformation)
    {
        $this->extraInformation = $extraInformation;

        return $this;
    }

    /**
     * Get extraInformation
     *
     * @return string
     */
    public function getExtraInformation()
    {
        return $this->extraInformation;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return DailyReport
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
