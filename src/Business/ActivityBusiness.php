<?php


namespace App\Business;


use App\Entity\Activity;
use App\Entity\Equipment;
use App\Entity\RequestBody\NewActivity;
use App\Entity\RequestBody\NewEquipment;
use App\Entity\User;
use App\Repository\ActivityRepository;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActivityBusiness
{
    private $userRepository;
    private $activityRepository;
    private $equipmentRepository;
    private $em;

    public function __construct
    (
        ActivityRepository $activityRepository,
        EquipmentRepository $equipmentRepository,
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->activityRepository = $activityRepository;
        $this->equipmentRepository = $equipmentRepository;
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
        $activity->setEquipment($equipment);
        $activity->setUserLink($user);
        $this->em->persist($activity);

        $this->em->flush();
        return $activity;
    }

    public function updateActivity(Activity $activity, NewActivity $updtActivity): Activity
    {
        $user = $this->userRepository->find($updtActivity->getUserId());
        $equipment = $this->equipmentRepository->find($updtActivity->getEquipmentId());

        $activity->setTitle($updtActivity->getTitle());
        $activity->setDescription($updtActivity->getDescription());
        $activity->setDepartureTime($updtActivity->getDepartureTime());
        $activity->setArrivalTime($updtActivity->getArrivalTime());
        $activity->setSpeedAverage($updtActivity->getSpeedAverage());
        $activity->setSpeedMax($updtActivity->getSpeedMax());
        $activity->setHeightDifference($updtActivity->getHeightDifference());
        $activity->setPowerAverage($updtActivity->getPowerAverage());
        $activity->setCaloriesConsumed($updtActivity->getCaloriesConsumed());
        $activity->setEquipment($equipment);
        $activity->setUserLink($user);
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