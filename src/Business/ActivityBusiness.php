<?php

namespace App\Business;

use App\Dto\NewActivity;
use App\Dto\UpdateActivity;
use App\Entity\Activity;
use App\Entity\User;
use App\Repository\ActivityRepository;
use App\Repository\ActivityTypeRepository;
use App\Repository\DifficultyRepository;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class ActivityBusiness
{
    public function __construct(
        private ActivityRepository $activityRepository,
        private EquipmentRepository $equipmentRepository,
        private ActivityTypeRepository $activityTypeRepository,
        private DifficultyRepository $difficultyRepository,
        private UserRepository $userRepository,
        private EntityManagerInterface $em
    )
    {}

    public function getActivity(): array
    {
        return $this->activityRepository->findAll();
    }

    public function getActivityByUser(User $user): array
    {
        return $this->activityRepository->findBy(['userLink' => $user]);
    }

    public function addActivity(NewActivity $newActivity): Activity
    {
        $activity = new Activity();
        $activity->setTitle($newActivity->title);
        $activity->setDescription($newActivity->description);
        $activity->setDepartureTime($newActivity->departureTime);
        $activity->setArrivalTime($newActivity->arrivalTime);
        $activity->setDistance($newActivity->distance);
        $activity->setSpeedAverage($newActivity->speedAverage);
        $activity->setSpeedMax($newActivity->speedMax);
        $activity->setHeightDifference($newActivity->heightDifference);
        $activity->setPowerAverage($newActivity->powerAverage);
        $activity->setCaloriesConsumed($newActivity->caloriesConsumed);
        if ($newActivity->activityTypeId !== null) {
            $activityType = $this->activityTypeRepository->find($newActivity->activityTypeId);
            $activity->setActivityType($activityType);
        }
        if ($newActivity->equipmentId !== null) {
            $equipment = $this->equipmentRepository->find($newActivity->equipmentId);
            $activity->setEquipment($equipment);
        }
        if ($newActivity->difficultyId !== null) {
            $difficulty = $this->difficultyRepository->find($newActivity->difficultyId);
            $activity->setDifficulty($difficulty);
        }
        if ($newActivity->userId !== null) {
            $user = $this->userRepository->find($newActivity->userId);
            $activity->setUserLink($user);
        }
        $this->em->persist($activity);
        $this->em->flush();

        return $activity;
    }

    public function updateActivity(Activity $activity, UpdateActivity $updtActivity): Activity
    {
        $updtActivity->title === null ?: $activity->setTitle($updtActivity->title);
        $updtActivity->description === null ?: $activity->setDescription($updtActivity->description);
        $updtActivity->departureTime === null ?: $activity->setDepartureTime($updtActivity->departureTime);
        $updtActivity->arrivalTime === null ?: $activity->setArrivalTime($updtActivity->arrivalTime);
        $updtActivity->distance === null ?: $activity->setDistance($updtActivity->distance);
        $updtActivity->speedAverage === null ?: $activity->setSpeedAverage($updtActivity->speedAverage);
        $updtActivity->speedMax === null ?: $activity->setSpeedMax($updtActivity->speedMax);
        $updtActivity->heightDifference === null ?: $activity->setHeightDifference($updtActivity->heightDifference);
        $updtActivity->powerAverage === null ?: $activity->setPowerAverage($updtActivity->powerAverage);
        $updtActivity->caloriesConsumed === null ?: $activity->setCaloriesConsumed($updtActivity->caloriesConsumed);

        if ($updtActivity->activityTypeId !== null) {
            $activityType = $this->activityTypeRepository->find($updtActivity->activityTypeId);
            $activity->setActivityType($activityType);
        }
        if ($updtActivity->equipmentId !== null) {
            $equipment = $this->equipmentRepository->find($updtActivity->equipmentId);
            $activity->setEquipment($equipment);
        }
        if ($updtActivity->difficultyId !== null) {
            $difficulty = $this->difficultyRepository->find($updtActivity->difficultyId);
            $activity->setDifficulty($difficulty);
        }
        if ($updtActivity->userId !== null) {
            $user = $this->userRepository->find($updtActivity->userId);
            $activity->setUserLink($user);
        }
        $this->em->persist($activity);
        $this->em->flush();

        return $activity;
    }

    public function delActivity(Activity $activity): void
    {
        $this->em->remove($activity);
        $this->em->flush();
    }
}