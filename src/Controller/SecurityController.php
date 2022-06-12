<?php

namespace App\Controller;

use App\Business\UserBusiness;
use App\Entity\RequestBody\NewUser;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/api")
 */
class SecurityController extends AbstractFOSRestController
{
    /**
     * @Route("/register", methods={"POST"})
     * @ParamConverter("newUser", class="App\Entity\RequestBody\NewUser", converter="fos_rest.request_body")
     */
    public function register(UserBusiness $userBusiness, NewUser $newUser)
    {
        $userToken = $userBusiness->register($newUser);

        $view = $this->view($userToken);
        return $this->handleView($view);
    }
}