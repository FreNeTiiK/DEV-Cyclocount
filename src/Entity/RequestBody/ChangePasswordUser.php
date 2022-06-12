<?php


namespace App\Entity\RequestBody;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class ChangePasswordUser
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $currentPassword;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $newPassword;

    /**
     * @return mixed
     */
    public function getCurrentPassword()
    {
        return $this->currentPassword;
    }

    /**
     * @param mixed $currentPassword
     */
    public function setCurrentPassword($currentPassword): void
    {
        $this->currentPassword = $currentPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     */
    public function setNewPassword($newPassword): void
    {
        $this->newPassword = $newPassword;
    }
}