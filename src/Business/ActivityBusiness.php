<?php


namespace App\Business;


use App\Entity\Activity;
use App\Entity\Equipment;
use App\Entity\RequestBody\NewActivity;
use App\Entity\RequestBody\NewEquipment;
use App\Entity\RequestBody\UpdateActivity;
use App\Entity\User;
use App\Repository\ActivityRepository;
use App\Repository\ActivityTypeRepository;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActivityBusiness
{
    private $userRepository;
    private $activityRepository;
    private $equipmentRepository;
    private $activityTypeRepository;
    private $em;

    public function __construct
    (
        ActivityRepository $activityRepository,
        EquipmentRepository $equipmentRepository,
        ActivityTypeRepository $activityTypeRepository,
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->activityRepository = $activityRepository;
        $this->equipmentRepository = $equipmentRepository;
        $this->activityTypeRepository = $activityTypeRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

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
        $user = $this->userRepository->find($newActivity->getUserId());
        $equipment = $this->equipmentRepository->find($newActivity->getEquipmentId());
        $activityType = $this->activityTypeRepository->find($newActivity->getActivityTypeId());

        $activity = new Activity();
        $activity->setTitle($newActivity->getTitle());
        $activity->setDescription($newActivity->getDescription());
        $activity->setDepartureTime($newActivity->getDepartureTime());
        $activity->setArrivalTime($newActivity->getArrivalTime());
        $activity->setSpeedAverage($newActivity->getSpeedAverage());
        $activity->setSpeedMax($newActivity->getSpeedMax());
        $activity->setHeightDifference($newActivity->getHeightDifference());
        $activity->setPowerAverage($newActivity->getPowerAverage());
        $activity->setCaloriesConsumed($newActivity->getCaloriesConsumed());
        $activity->setActivityType($activityType);
        $activity->setEquipment($equipment);
        $activity->setUserLink($user);
        $this->em->persist($activity);
        $this->em->flush();

        return $activity;
    }

    public function updateActivity(Activity $activity, UpdateActivity $updtActivity): Activity
    {
        $updtActivity->getTitle() === null ?: $activity->setTitle($updtActivity->getTitle());
        $updtActivity->getDescription() === null ?: $activity->setDescription($updtActivity->getDescription());
        $updtActivity->getDepartureTime() === null ?: $activity->setDepartureTime($updtActivity->getDepartureTime());
        $updtActivity->getArrivalTime() === null ?: $activity->setArrivalTime($updtActivity->getArrivalTime());
        $updtActivity->getSpeedAverage() === null ?: $activity->setSpeedAverage($updtActivity->getSpeedAverage());
        $updtActivity->getSpeedMax() === null ?: $activity->setSpeedMax($updtActivity->getSpeedMax());
        $updtActivity->getHeightDifference() === null ?: $activity->setHeightDifference($updtActivity->getHeightDifference());
        $updtActivity->getPowerAverage() === null ?: $activity->setPowerAverage($updtActivity->getPowerAverage());
        $updtActivity->getCaloriesConsumed() === null ?: $activity->setCaloriesConsumed($updtActivity->getCaloriesConsumed());

        if ($updtActivity->getActivityTypeId() !== null) {
            $activityType = $this->activityTypeRepository->find($updtActivity->getActivityTypeId());
            $activity->setActivityType($activityType);
        }
        if ($updtActivity->getEquipmentId() !== null) {
            $equipment = $this->equipmentRepository->find($updtActivity->getEquipmentId());
            $activity->setEquipment($equipment);
        }
        if ($updtActivity->getUserId() !== null) {
            $user = $this->userRepository->find($updtActivity->getUserId());
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