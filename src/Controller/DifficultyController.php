<?php

namespace App\Controller;

use App\Business\DifficultyBusiness;
use App\Business\EquipmentBusiness;
use App\Entity\ActivityType;
use App\Entity\Equipment;
use App\Entity\RequestBody\NewEquipment;
use App\Entity\RequestBody\UpdateEquipment;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/api/difficulty")
 */
class DifficultyController extends AbstractFOSRestController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function getDifficulty(DifficultyBusiness $difficultyBusiness)
    {
        $difficulty = $difficultyBusiness->getDifficulties();

        $view = $this->view($difficulty);
        return $this->handleView($view);
    }

}