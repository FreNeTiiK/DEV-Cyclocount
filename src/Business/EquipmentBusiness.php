<?php


namespace App\Business;


use App\Entity\ActivityType;
use App\Entity\Equipment;
use App\Entity\RequestBody\NewEquipment;
use App\Entity\RequestBody\UpdateEquipment;
use App\Entity\User;
use App\Repository\ActivityTypeRepository;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class EquipmentBusiness
{
    private $userRepository;
    private $equipmentRepository;
    private $activityTypeRepository;
    private $em;

    public function __construct
    (
        EquipmentRepository $equipmentRepository,
        ActivityTypeRepository $activityTypeRepository,
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->equipmentRepository = $equipmentRepository;
        $this->activityTypeRepository = $activityTypeRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function getEquipments(): array
    {
        return $this->equipmentRepository->findAll();
    }

    public function getEquipmentsByUser(User $user, ?ActivityType $activityType = null): array
    {
        $filter = ['userLink' => $user];
        if ($activityType !== null) {
            $filter['activityType'] = $activityType;
        }

        return $this->equipmentRepository->findBy($filter);
    }

    public function addEquipment(NewEquipment $newEquipment): Equipment
    {
        $user = $this->userRepository->find($newEquipment->getUserId());
        $activity = $this->activityTypeRepository->find($newEquipment->getActivityTypeId());

        $equipment = new Equipment();
        $equipment->setName($newEquipment->getName());
        $equipment->setActivityType($activity);
        $equipment->setUserLink($user);
        $this->em->persist($equipment);
        $this->em->flush();

        return $equipment;
    }

    public function updateEquipment(Equipment $equipment, UpdateEquipment $updateEquipment): Equipment
    {
        $equipment->setName($updateEquipment->getName());
        if ($updateEquipment->getActivityTypeId() !== null) {
            $activity = $this->activityTypeRepository->find($updateEquipment->getActivityTypeId());
            $equipment->setActivityType($activity);
        }
        if ($updateEquipment->getActivityTypeId() !== null) {
            $user = $this->userRepository->find($updateEquipment->getUserId());
            $equipment->setUserLink($user);
        }
        $this->em->persist($equipment);
        $this->em->flush();

        return $equipment;
    }

    public function delEquipment(Equipment $equipment): void
    {
        $this->em->remove($equipment);
        $this->em->flush();
    }
}