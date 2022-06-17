<?php

namespace App\Controller;

use App\Business\ActivityBusiness;
use App\Business\HomeBusiness;
use App\Entity\Activity;
use App\Entity\ActivityType;
use App\Entity\RequestBody\NewActivity;
use App\Entity\RequestBody\UpdateActivity;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/api/home")
 */
class HomeController extends AbstractFOSRestController
{
    /**
     * @Route("/data", methods={"GET"})
     */
    public function getHomeDataWidgets(HomeBusiness $homeBusiness, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $homeData = $homeBusiness->getHomeDataWidgets($user);

        $view = $this->view($homeData);
        return $this->handleView($view);
    }

    /**
     * @Route("/charts", methods={"GET"})
     */
    public function getHomeDataCharts(HomeBusiness $homeBusiness, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $homeData = $homeBusiness->getHomeDataCharts($user);

        $view = $this->view($homeData);
        return $this->handleView($view);
    }
}