<?php


namespace App\Business;

use App\Entity\RequestBody\ChangePasswordUser;
use App\Entity\RequestBody\UpdateUser;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserBusiness
{
    private $userRepository;
    private $em;
    private $encoder;

    public function __construct
    (
        UserRepository $userRepository,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $encoder
    )
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
        $this->encoder = $encoder;
    }

    public function getUserByUsername(string $username): User
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }

    public function updateUser(User $user, UpdateUser $updateUser): User
    {
        $updateUser->getFirstName() === null ?: $user->setFirstName($updateUser->getFirstName());
        $updateUser->getLastName() === null ?: $user->setLastName($updateUser->getLastName());
        $updateUser->getUsername() === null ?: $user->setUsername($updateUser->getUsername());
        $updateUser->getBirthday() === null ?: $user->setBirthday($updateUser->getBirthday());
        $updateUser->getAddress() === null ?: $user->setAddress($updateUser->getAddress());
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function changePassword(User $user, ChangePasswordUser $changePasswordUser): void
    {
        $plainCurrentPassword = $changePasswordUser->getCurrentPassword();
        $isValidPassword = $this->encoder->isPasswordValid($user, $plainCurrentPassword);

        if (!$isValidPassword) {
            throw new InvalidArgumentException('Le mot de passe actuel est incorrect');
        }

        $plainNewPassword = $changePasswordUser->getNewPassword();
        $encodedNewPassword = $this->encoder->hashPassword($user, $plainNewPassword);
        $user->setPassword($encodedNewPassword);
        $this->em->persist($user);
        $this->em->flush();
    }
}