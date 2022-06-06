<?php


namespace App\Entity\RequestBody;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class NewActivity
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $description;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTime<'H:i:s'>")
     */
    private $departureTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTime<'H:i:s'>")
     */
    private $arrivalTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("float")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $speedAverage;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("float")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $speedMax;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $heightDifference;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $powerAverage;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $caloriesConsumed;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $userId;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @param mixed $departureTime
     */
    public function setDepartureTime($departureTime): void
    {
        $this->departureTime = $departureTime;
    }

    /**
     * @return mixed
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * @param mixed $arrivalTime
     */
    public function setArrivalTime($arrivalTime): void
    {
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * @return mixed
     */
    public function getSpeedAverage()
    {
        return $this->speedAverage;
    }

    /**
     * @param mixed $speedAverage
     */
    public function setSpeedAverage($speedAverage): void
    {
        $this->speedAverage = $speedAverage;
    }

    /**
     * @return mixed
     */
    public function getSpeedMax()
    {
        return $this->speedMax;
    }

    /**
     * @param mixed $speedMax
     */
    public function setSpeedMax($speedMax): void
    {
        $this->speedMax = $speedMax;
    }

    /**
     * @return mixed
     */
    public function getHeightDifference()
    {
        return $this->heightDifference;
    }

    /**
     * @param mixed $heightDifference
     */
    public function setHeightDifference($heightDifference): void
    {
        $this->heightDifference = $heightDifference;
    }

    /**
     * @return mixed
     */
    public function getPowerAverage()
    {
        return $this->powerAverage;
    }

    /**
     * @param mixed $powerAverage
     */
    public function setPowerAverage($powerAverage): void
    {
        $this->powerAverage = $powerAverage;
    }

    /**
     * @return mixed
     */
    public function getCaloriesConsumed()
    {
        return $this->caloriesConsumed;
    }

    /**
     * @param mixed $caloriesConsumed
     */
    public function setCaloriesConsumed($caloriesConsumed): void
    {
        $this->caloriesConsumed = $caloriesConsumed;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

}