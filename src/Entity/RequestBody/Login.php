<?php

namespace App\Entity\RequestBody;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @Serializer\ExclusionPolicy("all")
 */
class Login
{
    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Serializer\Expose()
     * @Serializer\Type("string")
     * @Assert\NotNull
     * @Assert\NotBlank()
     */
    private $password;


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}
