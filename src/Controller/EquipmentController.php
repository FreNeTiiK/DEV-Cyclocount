<?php

namespace App\Controller;

use App\Business\EquipmentBusiness;
use App\Dto\NewEquipment;
use App\Dto\UpdateEquipment;
use App\Entity\ActivityType;
use App\Entity\Equipment;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/equipments')]
class EquipmentController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getEquipments(EquipmentBusiness $equipmentBusiness): Response
    {
        $equipments = $equipmentBusiness->getEquipments();

        return $this->json($equipments, 200, [], ['groups' => '*']);
    }

    #[Route('/{user}/{activityType}', methods: ['GET'])]
    public function getEquipmentsByUser(
        EquipmentBusiness $equipmentBusiness,
        User $user,
        ?ActivityType $activityType = null
    ): Response
    {
        $equipments = $equipmentBusiness->getEquipmentsByUser($user, $activityType);

        return $this->json($equipments, 200, [], ['groups' => '*']);
    }

    #[Route('', methods: ['POST'])]
    public function addEquipment(
        EquipmentBusiness $equipmentBusiness,
        #[MapRequestPayload] NewEquipment $newEquipment
    ): Response
    {
        $equipment = $equipmentBusiness->addEquipment($newEquipment);

        return $this->json($equipment, 201, [], ['groups' => '*']);
    }

    #[Route('/{equipment}', methods: ['PUT'])]
    public function updateEquipment(
        EquipmentBusiness $equipmentBusiness,
        Equipment $equipment,
        #[MapRequestPayload] UpdateEquipment $updateEquipment
    ): Response
    {
        $equipment = $equipmentBusiness->updateEquipment($equipment, $updateEquipment);

        return $this->json($equipment, 200, [], ['groups' => '*']);
    }

    #[Route('/{equipment}', methods: ['DELETE'])]
    public function delEquipment(EquipmentBusiness $equipmentBusiness, Equipment $equipment): Response
    {
        $equipmentBusiness->delEquipment($equipment);

        return new Response();
    }

}