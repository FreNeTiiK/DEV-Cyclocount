<?php

namespace App\Controller;

use App\Business\ActivityBusiness;
use App\Entity\Activity;
use App\Entity\ActivityType;
use App\Entity\RequestBody\NewActivity;
use App\Entity\RequestBody\UpdateActivity;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/api/activities")
 */
class ActivityController extends AbstractFOSRestController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function getActivity(ActivityBusiness $activityBusiness): Response
    {
        $activity = $activityBusiness->getActivity();

        $view = $this->view($activity);
        return $this->handleView($view);
    }

    /**
     * @Route("", methods={"POST"})
     * @ParamConverter("newActivity", class="App\Entity\RequestBody\NewActivity", converter="fos_rest.request_body")
     */
    public function addActivity(ActivityBusiness $activityBusiness, NewActivity $newActivity): Response
    {
        $activity = $activityBusiness->addActivity($newActivity);

        $view = $this->view($activity);
        return $this->handleView($view);
    }

    /**
     * @Route("/{activity}", methods={"DELETE"})
     */
    public function delEquipment(ActivityBusiness $activityBusiness, Activity $activity): Response
    {
        $activityBusiness->delActivity($activity);

        $view = $this->view();
        return $this->handleView($view);
    }

    /**
     * @Route("/{activity}", methods={"PUT"})
     * @ParamConverter("updateActivity", class="App\Entity\RequestBody\UpdateActivity", converter="fos_rest.request_body")
     */
    public function updateActivity(ActivityBusiness $activityBusiness, Activity $activity, UpdateActivity $updateActivity): Response
    {
        $activityBusiness->updateActivity($activity, $updateActivity);

        $view = $this->view();
        return $this->handleView($view);
    }

    /**
     * @Route("/{user}", methods={"GET"})
     */
    public function getActivityByUser(ActivityBusiness $activityBusiness, User $user): Response
    {
        $activity = $activityBusiness->getActivityByUser($user);

        $view = $this->view($activity);
        return $this->handleView($view);
    }
}