<?php


namespace App\Business;


use App\Entity\Activity;
use App\Entity\Equipment;
use App\Entity\RequestBody\NewActivity;
use App\Entity\RequestBody\NewEquipment;
use App\Repository\ActivityRepository;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActivityBusiness
{
    private $userRepository;
    private $activityRepository;
    private $em;

    public function __construct
    (
        ActivityRepository $activityRepository,
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->activityRepository = $activityRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function getActivity(): array
    {
        return $this->activityRepository->findAll();
    }

    public function addActivity(NewActivity $newActivity): Activity
    {
        $user = $this->userRepository->find($newActivity->getUserId());
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