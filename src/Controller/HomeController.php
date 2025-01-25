<?php

namespace App\Controller;

use App\Business\HomeBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('/api/home')]
class HomeController extends AbstractController
{
    #[Route('/data', methods: ['GET'])]
    public function getHomeDataWidgets(HomeBusiness $homeBusiness, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $homeData = $homeBusiness->getHomeDataWidgets($user);

        return $this->json($homeData);
    }

    #[Route('/charts', methods: ['GET'])]
    public function getHomeDataCharts(HomeBusiness $homeBusiness, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $homeData = $homeBusiness->getHomeDataCharts($user);

        return $this->json($homeData);
    }
}