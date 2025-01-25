<?php

namespace App\Controller;

use App\Business\UserBusiness;
use App\Dto\ChangePasswordUser;
use App\Dto\UpdateUser;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/users')]
class UserController extends AbstractController
{
    #[Route('/{username}', methods: ['GET'])]
    public function getUserByUsername(UserBusiness $userBusiness, string $username): Response
    {
        $user = $userBusiness->getUserByUsername($username);

        return $this->json($user, 200, [], ['groups' => '*']);
    }

    #[Route('/checkUsername/{username}', methods: ['GET'])]
    public function checkUsername(UserBusiness $userBusiness, string $username): Response
    {
        $usernameExists = $userBusiness->checkUsername($username);

        return $this->json($usernameExists, 200, [], ['groups' => '*']);
    }

    #[Route('/{user}', methods: ['PUT'])]
    public function updateUser(
        UserBusiness $userBusiness,
        User $user,
        #[MapRequestPayload] UpdateUser $updateUser
    ): Response
    {
        $updatedUser = $userBusiness->updateUser($user, $updateUser);

        return $this->json($updatedUser, 200, [], ['groups' => '*']);
    }

    #[Route('/changePassword/{user}', methods: ['PUT'])]
    public function changePassword(
        UserBusiness $userBusiness,
        User $user,
        #[MapRequestPayload] ChangePasswordUser $changePasswordUser
    ): Response
    {
        $userBusiness->changePassword($user, $changePasswordUser);

        return new Response();
    }
}