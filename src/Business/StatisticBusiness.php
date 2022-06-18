<?php


namespace App\Business;


use App\Entity\Activity;
use App\Entity\ActivityType;
use App\Repository\ActivityRepository;
use App\Repository\AnnualObjectiveRepository;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;

class StatisticBusiness
{
    private $activityRepository;
    private $annualObjectiveRepository;

    public function __construct
    (
        ActivityRepository $activityRepository,
        AnnualObjectiveRepository $annualObjectiveRepository
    )
    {
        $this->activityRepository = $activityRepository;
        $this->annualObjectiveRepository = $annualObjectiveRepository;
    }

    public function getCharts(UserInterface $user, ActivityType $activityType): array
    {
        foreach (['all', 30, 15] as $activityNumber) {
            $kmData = $averageSpeedData = $maxSpeedData = $consumedCaloriesData = $averagePowerData = [];
            $activities = $this->activityRepository->findLastActivities(
                $user,
                $activityType,
                $activityNumber === 'all' ? null : $activityNumber
            );

            /** @var $activities Activity[] */
            foreach ($activities as $activity) {
                $kmData[] = ['x' => $activity->getDepartureTime(), 'y' => $activity->getDistance()];
                $averageSpeedData[] = ['x' => $activity->getDepartureTime(), 'y' => $activity->getSpeedAverage()];
                $maxSpeedData[] = ['x' => $activity->getDepartureTime(), 'y' => $activity->getSpeedMax()];
                $consumedCaloriesData[] = ['x' => $activity->getDepartureTime(), 'y' => $activity->getCaloriesConsumed()];
                $averagePowerData[] = ['x' => $activity->getDepartureTime(), 'y' => $activity->getPowerAverage()];
            }

            $kmsChartData['series'][$activityNumber][] = ['name' => 'Kilomètres', 'data' => $kmData];
            $speedChartData['series'][$activityNumber][] = ['name' => 'Vitesse maximale', 'data' => $maxSpeedData];
            $speedChartData['series'][$activityNumber][] = ['name' => 'Vitesse moyenne', 'data' => $averageSpeedData];
            $powerChartData['series'][$activityNumber][] = ['name' => 'Calories consommées', 'data' => $consumedCaloriesData];
            $powerChartData['series'][$activityNumber][] = ['name' => 'Puissance moyenne', 'data' => $averagePowerData];
        }

        return [
            'km' => $kmsChartData,
            'speed' => $speedChartData,
            'power' => $powerChartData,
        ];
    }

    /** @throws Exception */
    public function getAnnualObjectiveChart(UserInterface $user, ActivityType $activityType): array
    {
        $annualObjectives = $this->annualObjectiveRepository->findBy(['userLink' => $user, 'activityType' => $activityType]);
        $currentYearActivities = $this->activityRepository->findActivitiesByYear($user, date('Y'), $activityType);
        $categories = [];
        $annualObjectiveData = [];
        $total = 0;


        foreach ($annualObjectives as $annualObjective) {
            $categories[] = $annualObjective->getName();
            $objectiveType = $annualObjective->getTypeObjective();

            /** @var Activity $activity */
            switch ($objectiveType->getName()) {
                case 'Kilomètres':
                    $total = 0;
                    foreach ($currentYearActivities as $activity) {
                        $total += $activity->getDistance();
                    }
                    break;
                case 'Durée':
                    $total = 0;
                    foreach ($currentYearActivities as $activity) {
                        $total += $activity->getDepartureTime()->diff($activity->getArrivalTime())->h;
                    }
                    break;
                case 'Vitesse':
                    $totalAverageSpeed = 0;
                    foreach ($currentYearActivities as $activity) {
                        $totalAverageSpeed += $activity->getSpeedAverage();
                    }
                    $total = $totalAverageSpeed / count($currentYearActivities);
                    break;
                case 'Sorties':
                    $total = count($currentYearActivities);
                    break;
                case 'Denivele':
                    $total = 0;
                    foreach ($currentYearActivities as $activity) {
                        $total += $activity->getHeightDifference();
                    }
                    break;
            }
            $percentValue = round($total * 100 / $annualObjective->getQuantity(), 2);
            $annualObjectiveData[] = min($percentValue, 100);
        }

        $annualObjectivesChartData['categories'] = $categories;
        $annualObjectivesChartData['series'][] = ['name' => 'Objectifs annuels', 'data' => $annualObjectiveData];

        return $annualObjectivesChartData;
    }
}