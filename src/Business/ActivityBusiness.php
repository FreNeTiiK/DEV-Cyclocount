<?php


namespace App\Business;


use App\Entity\Activity;
use App\Entity\RequestBody\NewActivity;
use App\Entity\RequestBody\UpdateActivity;
use App\Entity\User;
use App\Repository\ActivityRepository;
use App\Repository\ActivityTypeRepository;
use App\Repository\DifficultyRepository;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ActivityBusiness
{
    private $userRepository;
    private $activityRepository;
    private $equipmentRepository;
    private $activityTypeRepository;
    private $difficultyRepository;
    private $em;

    public function __construct
    (
        ActivityRepository $activityRepository,
        EquipmentRepository $equipmentRepository,
        ActivityTypeRepository $activityTypeRepository,
        DifficultyRepository $difficultyRepository,
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->activityRepository = $activityRepository;
        $this->equipmentRepository = $equipmentRepository;
        $this->activityTypeRepository = $activityTypeRepository;
        $this->difficultyRepository = $difficultyRepository;
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
        $activity = new Activity();
        $activity->setTitle($newActivity->getTitle());
        $activity->setDescription($newActivity->getDescription());
        $activity->setDepartureTime($newActivity->getDepartureTime());
        $activity->setArrivalTime($newActivity->getArrivalTime());
        $activity->setDistance($newActivity->getDistance());
        $activity->setSpeedAverage($newActivity->getSpeedAverage());
        $activity->setSpeedMax($newActivity->getSpeedMax());
        $activity->setHeightDifference($newActivity->getHeightDifference());
        $activity->setPowerAverage($newActivity->getPowerAverage());
        $activity->setCaloriesConsumed($newActivity->getCaloriesConsumed());
        if ($newActivity->getActivityTypeId() !== null) {
            $activityType = $this->activityTypeRepository->find($newActivity->getActivityTypeId());
            $activity->setActivityType($activityType);
        }
        if ($newActivity->getEquipmentId() !== null) {
            $equipment = $this->equipmentRepository->find($newActivity->getEquipmentId());
            $activity->setEquipment($equipment);
        }
        if ($newActivity->getDifficultyId() !== null) {
            $difficulty = $this->difficultyRepository->find($newActivity->getDifficultyId());
            $activity->setDifficulty($difficulty);
        }
        if ($newActivity->getUserId() !== null) {
            $user = $this->userRepository->find($newActivity->getUserId());
            $activity->setUserLink($user);
        }
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
        $updtActivity->getDistance() === null ?: $activity->setDistance($updtActivity->getDistance());
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
        if ($updtActivity->getDifficultyId() !== null) {
            $difficulty = $this->difficultyRepository->find($updtActivity->getDifficultyId());
            $activity->setDifficulty($difficulty);
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

    public function getChartKms(UserInterface $user): array
    {
        $kmChartData = [];
        $activityTypes = $this->activityTypeRepository->findAll();

        foreach ($activityTypes as $activityType) {
            $activities = $this->activityRepository->findLastActivities($user, $activityType, 30);
            $data = [];

            /**
             * @var $activities Activity[]
             */
            foreach ($activities as $activity) {
                $data[] = ['x' => $activity->getDepartureTime(), 'y' => $activity->getDistance()];
            }

            $kmChartData['km']['series'][$activityType->getCode()][] = ['name' => 'Kilomètres', 'data' => $data];
        }

        return $kmChartData;
    }
}