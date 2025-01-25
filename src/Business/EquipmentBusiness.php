<?php

namespace App\Business;

use App\Dto\NewEquipment;
use App\Dto\UpdateEquipment;
use App\Entity\ActivityType;
use App\Entity\Equipment;
use App\Entity\User;
use App\Repository\ActivityTypeRepository;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class EquipmentBusiness
{
    public function __construct(
        private EquipmentRepository $equipmentRepository,
        private ActivityTypeRepository $activityTypeRepository,
        private UserRepository $userRepository,
        private EntityManagerInterface $em
    )
    {}

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
        $user = $this->userRepository->find($newEquipment->userId);
        $activity = $this->activityTypeRepository->find($newEquipment->activityTypeId);

        $equipment = new Equipment();
        $equipment->setName($newEquipment->name);
        $equipment->setActivityType($activity);
        $equipment->setUserLink($user);
        $this->em->persist($equipment);
        $this->em->flush();

        return $equipment;
    }

    public function updateEquipment(Equipment $equipment, UpdateEquipment $updateEquipment): Equipment
    {
        $equipment->setName($updateEquipment->name);
        if ($updateEquipment->activityTypeId !== null) {
            $activity = $this->activityTypeRepository->find($updateEquipment->activityTypeId);
            $equipment->setActivityType($activity);
        }
        if ($updateEquipment->userId !== null) {
            $user = $this->userRepository->find($updateEquipment->userId);
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