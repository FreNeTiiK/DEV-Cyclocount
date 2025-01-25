<?php

namespace App\Controller;

use App\Business\StatisticBusiness;
use App\Entity\ActivityType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('/api/statistics')]
class StatisticController extends AbstractController
{
    #[Route('/charts/{activityType}', methods: ['GET'])]
    public function getCharts(
        StatisticBusiness $statisticBusiness,
        TokenStorageInterface $tokenStorage,
        ActivityType $activityType
    ): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $chartsData = $statisticBusiness->getCharts($user, $activityType);

        return $this->json($chartsData);
    }

    /**
     * @throws Exception
     */
    #[Route('/annualObjectives/{activityType}', methods: ['GET'])]
    public function getAnnualObjectiveChart(
        StatisticBusiness $statisticBusiness,
        TokenStorageInterface $tokenStorage,
        ActivityType $activityType
    ): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $annualObjectivesChartData = $statisticBusiness->getAnnualObjectiveChart($user, $activityType);

        return $this->json($annualObjectivesChartData);
    }
}