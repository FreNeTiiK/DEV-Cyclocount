<?php

namespace App\Controller;

use App\Business\ActivityBusiness;
use App\Entity\Activity;
use App\Entity\RequestBody\NewActivity;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/api/activities")
 */
class ActivityController extends AbstractFOSRestController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function getActivity(ActivityBusiness $activityBusiness)
    {
        $activity = $activityBusiness->getActivity();

        $view = $this->view($activity);
        return $this->handleView($view);
    }

    /**
     * @Route("", methods={"POST"})
     * @ParamConverter("newActivity", class="App\Entity\RequestBody\NewActivity", converter="fos_rest.request_body")
     */
    public function addActivity(ActivityBusiness $activityBusiness, NewActivity $newActivity)
    {
        $activity = $activityBusiness->addActivity($newActivity);

        $view = $this->view($activity);
        return $this->handleView($view);
    }

    /**
     * @Route("/{activity}", methods={"DELETE"})
     */
    public function delEquipment(ActivityBusiness $activityBusiness, Activity $activity)
    {
        $activityBusiness->delActivity($activity);

        $view = $this->view();
        return $this->handleView($view);
    }

}