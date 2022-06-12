<?php

namespace App\Controller;

use App\Business\UserBusiness;
use App\Entity\RequestBody\ChangePasswordUser;
use App\Entity\RequestBody\NewUser;
use App\Entity\RequestBody\UpdateUser;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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

    /**
     * @Route("/checkUsername/{username}", methods={"GET"})
     */
    public function checkUsername(UserBusiness $userBusiness, string $username)
    {
        $usernameExists = $userBusiness->checkUsername($username);

        $view = $this->view($usernameExists);
        return $this->handleView($view);
    }

    /**
     * @Route("/{user}", methods={"PUT"})
     * @ParamConverter("updateUser", class="App\Entity\RequestBody\UpdateUser", converter="fos_rest.request_body")
     */
    public function updateUser(UserBusiness $userBusiness, User $user, UpdateUser $updateUser)
    {
        $updatedUser = $userBusiness->updateUser($user, $updateUser);

        $view = $this->view($user);
        return $this->handleView($view);
    }

    /**
     * @Route("/changePassword/{user}", methods={"PUT"})
     * @ParamConverter("changePasswordUser", class="App\Entity\RequestBody\ChangePasswordUser", converter="fos_rest.request_body")
     */
    public function changePassword(UserBusiness $userBusiness, User $user, ChangePasswordUser $changePasswordUser)
    {
        $userBusiness->changePassword($user, $changePasswordUser);

        $view = $this->view();
        return $this->handleView($view);
    }
}