<?php


namespace App\Entity\RequestBody;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class NewAnnualObjective
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("integer")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $quantity;

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


}