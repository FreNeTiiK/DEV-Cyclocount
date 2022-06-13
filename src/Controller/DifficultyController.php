<?php

namespace App\Controller;

use App\Business\DifficultyBusiness;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/difficulties")
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