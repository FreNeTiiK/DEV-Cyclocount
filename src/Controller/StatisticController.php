<?php

namespace App\Controller;

use App\Business\StatisticBusiness;
use App\Entity\ActivityType;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/api/statistics")
 */
class StatisticController extends AbstractFOSRestController
{
    /**
     * @Route("/charts/{activityType}", methods={"GET"})
     */
    public function getCharts(
        StatisticBusiness $statisticBusiness,
        TokenStorageInterface $tokenStorage,
        ActivityType $activityType
    ): Response {
        $user = $tokenStorage->getToken()->getUser();
        $chartsData = $statisticBusiness->getCharts($user, $activityType);

        $view = $this->view($chartsData);
        return $this->handleView($view);
    }

    /**
     * @Route("/annualObjectives/{activityType}", methods={"GET"})
     * @throws Exception
     */
    public function getAnnualObjectiveChart(
        StatisticBusiness $statisticBusiness,
        TokenStorageInterface $tokenStorage,
        ActivityType $activityType
    ): Response {
        $user = $tokenStorage->getToken()->getUser();
        $annualObjectivesChartData = $statisticBusiness->getAnnualObjectiveChart($user, $activityType);

        $view = $this->view($annualObjectivesChartData);
        return $this->handleView($view);
    }
}