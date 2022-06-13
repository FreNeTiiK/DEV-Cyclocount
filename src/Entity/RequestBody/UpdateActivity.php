<?php


namespace App\Entity\RequestBody;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class UpdateActivity
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $title;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $description;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $departureTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $arrivalTime;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("float")
     */
    private $distance;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("float")
     */
    private $speedAverage;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("float")
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
     */
    private $activityTypeId;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $equipmentId;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $difficultyId;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
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
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance): void
    {
        $this->distance = $distance;
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
    public function getActivityTypeId()
    {
        return $this->activityTypeId;
    }

    /**
     * @param mixed $activityTypeId
     */
    public function setActivityTypeId($activityTypeId): void
    {
        $this->activityTypeId = $activityTypeId;
    }

    /**
     * @return mixed
     */
    public function getEquipmentId()
    {
        return $this->equipmentId;
    }

    /**
     * @param mixed $equipmentId
     */
    public function setEquipmentId($equipmentId): void
    {
        $this->equipmentId = $equipmentId;
    }

    /**
     * @return mixed
     */
    public function getDifficultyId()
    {
        return $this->difficultyId;
    }

    /**
     * @param mixed $difficultyId
     */
    public function setDifficultyId($difficultyId): void
    {
        $this->difficultyId = $difficultyId;
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