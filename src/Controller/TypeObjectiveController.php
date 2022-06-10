<?php

namespace App\Controller;

use App\Business\TypeObjectiveBusiness;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/typeObjectives")
 */
class TypeObjectiveController extends AbstractFOSRestController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function getTypeObjectives(TypeObjectiveBusiness $typeObjectiveBusiness)
    {
        $typeObjectives = $typeObjectiveBusiness->getTypeObjectives();

        $view = $this->view($typeObjectives);
        return $this->handleView($view);
    }
}