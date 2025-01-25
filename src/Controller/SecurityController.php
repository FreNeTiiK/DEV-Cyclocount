<?php

namespace App\Controller;

use App\Business\UserBusiness;
use App\Dto\NewUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class SecurityController extends AbstractController
{
    #[Route('/register', methods: ['POST'])]
    public function register(
        UserBusiness $userBusiness,
        #[MapRequestPayload] NewUser $newUser
    ): Response
    {
        $userToken = $userBusiness->register($newUser);

        return $this->json($userToken);
    }
}