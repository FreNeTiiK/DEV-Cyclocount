<?php

namespace App\Controller;

use App\Business\UserBusiness;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/users")
 */
class UserController extends AbstractFOSRestController
{
    /**
     * @Route("/{username}", methods={"GET"})
     */
    public function getUserByUsername(UserBusiness $userBusiness, string $username)
    {
        $user = $userBusiness->getUserByUsername($username);

        $view = $this->view($user);
        return $this->handleView($view);
    }
}