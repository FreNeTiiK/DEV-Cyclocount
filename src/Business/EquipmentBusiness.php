<?php


namespace App\Business;


use App\Entity\Equipment;
use App\Entity\RequestBody\NewEquipment;
use App\Entity\User;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class EquipmentBusiness
{
    private $userRepository;
    private $equipmentRepository;
    private $em;

    public function __construct
    (
        EquipmentRepository $equipmentRepository,
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->equipmentRepository = $equipmentRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function getEquipments(): array
    {
        return $this->equipmentRepository->findAll();
    }

    public function getEquipmentsByUser(User $user): array
    {
        return $this->equipmentRepository->findBy(['userLink' => $user]);
    }

    public function addEquipment(NewEquipment $newEquipment): Equipment
    {
        $user = $this->userRepository->find($newEquipment->getUserId());

        $equipment = new Equipment();
        $equipment->setName($newEquipment->getName());
        $equipment->setUserLink($user);
        $this->em->persist($equipment);
        $this->em->flush();
        return $equipment;
    }

    public function updateEquipment(Equipment $equipment, NewEquipment $newEquipment): Equipment
    {
        $user = $this->userRepository->find($newEquipment->getUserId());

        $equipment->setName($newEquipment->getName());
        $equipment->setUserLink($user);
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