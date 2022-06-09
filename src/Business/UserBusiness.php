<?php


namespace App\Business;

use App\Entity\User;
use App\Repository\UserRepository;

class UserBusiness
{
    private $userRepository;

    public function __construct
    (
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function getUserByUsername(string $username): User
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }
}