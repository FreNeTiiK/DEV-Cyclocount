<?php

namespace App\Controller;

use App\Business\ActivityTypeBusiness;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/activityTypes")
 */
class ActivityTypeController extends AbstractFOSRestController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function getActivityTypes(ActivityTypeBusiness $activityTypeBusiness)
    {
        $activityTypes = $activityTypeBusiness->getActivityTypes();

        $view = $this->view($activityTypes);
        return $this->handleView($view);
    }
}