<?php

namespace App\Business;

use App\Dto\ChangePasswordUser;
use App\Dto\NewUser;
use App\Dto\UpdateUser;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserBusiness
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $encoder,
        private JWTTokenManagerInterface $JWTManager
    )
    {}

    public function getUserByUsername(string $username): User
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }

    public function checkUsername(string $username): bool
    {
        return $this->userRepository->findOneBy(['username' => $username]) !== null;
    }

    public function register(NewUser $newUser): array
    {
        $userByUsername = $this->userRepository->findOneBy(['username' => $newUser->username]);
        if ($userByUsername !== null) {
            throw new InvalidArgumentException('Ce nom d\'utilisateur existe déjà !');
        }
        $user = new User();
        $user->setFirstName($newUser->firstName);
        $user->setLastName($newUser->lastName);
        $user->setUsername($newUser->username);
        $user->setBirthday($newUser->birthday);
        $user->setAddress($newUser->address);
        $encodedPassword = $this->encoder->hashPassword($user, $newUser->password);
        $user->setPassword($encodedPassword);

        $this->em->persist($user);
        $this->em->flush();

        return ['user' => $user, 'token' => $this->JWTManager->create($user)];
    }

    public function updateUser(User $user, UpdateUser $updateUser): User
    {
        $updateUser->firstName === null ?: $user->setFirstName($updateUser->firstName);
        $updateUser->lastName === null ?: $user->setLastName($updateUser->lastName);
        $updateUser->username === null ?: $user->setUsername($updateUser->username);
        $updateUser->birthday === null ?: $user->setBirthday($updateUser->birthday);
        $updateUser->address === null ?: $user->setAddress($updateUser->address);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function changePassword(User $user, ChangePasswordUser $changePasswordUser): void
    {
        $plainCurrentPassword = $changePasswordUser->currentPassword;
        $isValidPassword = $this->encoder->isPasswordValid($user, $plainCurrentPassword);

        if (!$isValidPassword) {
            throw new InvalidArgumentException('Le mot de passe actuel est incorrect');
        }

        $plainNewPassword = $changePasswordUser->newPassword;
        $encodedNewPassword = $this->encoder->hashPassword($user, $plainNewPassword);
        $user->setPassword($encodedNewPassword);
        $this->em->persist($user);
        $this->em->flush();
    }
}