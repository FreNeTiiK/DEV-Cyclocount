<?php

namespace App\Business;

use App\Repository\ActivityRepository;
use App\Repository\ActivityTypeRepository;
use App\Repository\DifficultyRepository;
use Symfony\Component\Security\Core\User\UserInterface;

readonly class HomeBusiness
{
    public function __construct(
        private ActivityRepository $activityRepository,
        private ActivityTypeRepository $activityTypeRepository,
        private DifficultyRepository $difficultyRepository
    )
    {}

    public function getHomeDataWidgets(UserInterface $user): array
    {
        $activities = $this->activityRepository->findBy(['userLink' => $user]);
        $activityNumber = count($activities);
        $totalDistance = 0;
        $consumedCalories = 0;
        $time = 0;

        foreach ($activities as $activity) {
            $totalDistance += $activity->getDistance();
            $consumedCalories += $activity->getCaloriesConsumed();
            $time += $activity->getDepartureTime()->diff($activity->getArrivalTime())->h;
        }

        return [
            'activityNumber' => $activityNumber,
            'totalDistance' => $totalDistance,
            'consumedCalories' => $consumedCalories,
            'time' => $time,
        ];
    }

    public function getHomeDataCharts(UserInterface $user): array
    {
        $activities = $this->activityRepository->findBy(['userLink' => $user]);
        $activityTypeChart = $this->getActivityTypeChart($activities);
        $activityDifficultyChart = $this->getActivityDifficultyChart($activities);

        return [
            'activityType' => $activityTypeChart,
            'difficulty' => $activityDifficultyChart,
        ];
    }

    public function getActivityTypeChart(array $activities): array
    {
        $activityTypes = $this->activityTypeRepository->findAll();
        $activityTypeChart['activities'] = count($activities);

        foreach ($activityTypes as $activityType) {
            $activitiesByType = array_filter($activities, function($activity) use ($activityType) {
                return $activity->getActivityType() === $activityType;
            });

            $activityTypeChart['series'][] = round(count($activitiesByType) * 100 / count($activities), 2);
            $activityTypeChart['labels'][] = $activityType->getName();
        }

        return $activityTypeChart;
    }

    public function getActivityDifficultyChart(array $activities): array
    {
        $difficulties = $this->difficultyRepository->findAll();
        $activityDifficultyChart['activities'] = count($activities);

        foreach ($difficulties as $difficulty) {
            $activitiesByDifficulty = array_filter($activities, function($activity) use ($difficulty) {
                return $activity->getDifficulty() === $difficulty;
            });

            $activityDifficultyChart['series'][] = round(count($activitiesByDifficulty) * 100 / count($activities), 2);
            $activityDifficultyChart['labels'][] = $difficulty->getName();
        }

        return $activityDifficultyChart;
    }
}