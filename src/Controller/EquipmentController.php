<?php

namespace App\Controller;

use App\Business\EquipmentBusiness;
use App\Entity\Equipment;
use App\Entity\RequestBody\NewEquipment;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/api/equipments")
 */
class EquipmentController extends AbstractFOSRestController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function getEquipments(EquipmentBusiness $equipmentBusiness)
    {
        $equipments = $equipmentBusiness->getEquipments();

        $view = $this->view($equipments);
        return $this->handleView($view);
    }

    /**
     * @Route("/{user}", methods={"GET"})
     */
    public function getEquipmentsByUser(EquipmentBusiness $equipmentBusiness, User $user)
    {
        $equipments = $equipmentBusiness->getEquipmentsByUser($user);

        $view = $this->view($equipments);
        return $this->handleView($view);
    }

    /**
     * @Route("", methods={"POST"})
     * @ParamConverter("newEquipment", class="App\Entity\RequestBody\NewEquipment", converter="fos_rest.request_body")
     */
    public function addEquipment(EquipmentBusiness $equipmentBusiness, NewEquipment $newEquipment)
    {
        $equipment = $equipmentBusiness->addEquipment($newEquipment);

        $view = $this->view($equipment);
        return $this->handleView($view);
    }

    /**
     * @Route("/{equipment}", methods={"PUT"})
     * @ParamConverter("newEquipment", class="App\Entity\RequestBody\NewEquipment", converter="fos_rest.request_body")
     */
    public function updateEquipment(EquipmentBusiness $equipmentBusiness, Equipment $equipment, NewEquipment $newEquipment)
    {
        $equipment = $equipmentBusiness->updateEquipment($equipment, $newEquipment);

        $view = $this->view($equipment);
        return $this->handleView($view);
    }

    /**
     * @Route("/{equipment}", methods={"DELETE"})
     */
    public function delEquipment(EquipmentBusiness $equipmentBusiness, Equipment $equipment)
    {
        $equipmentBusiness->delEquipment($equipment);

        $view = $this->view();
        return $this->handleView($view);
    }

}