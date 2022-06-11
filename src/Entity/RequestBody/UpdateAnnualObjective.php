<?php


namespace App\Entity\RequestBody;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class UpdateAnnualObjective
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $quantity;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $activityTypeId;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $typeObjectiveId;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     */
    private $userId;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
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
    public function getTypeObjectiveId()
    {
        return $this->typeObjectiveId;
    }

    /**
     * @param mixed $typeObjectiveId
     */
    public function setTypeObjectiveId($typeObjectiveId): void
    {
        $this->typeObjectiveId = $typeObjectiveId;
    }
}