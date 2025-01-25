<?php

namespace App\Controller;

use App\Business\ActivityBusiness;
use App\Dto\NewActivity;
use App\Dto\UpdateActivity;
use App\Entity\Activity;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/activities')]
class ActivityController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getActivity(ActivityBusiness $activityBusiness): Response
    {
        $activity = $activityBusiness->getActivity();

        return $this->json($activity, 200, [], ['groups' => '*']);
    }

    #[Route('', methods: ['POST'])]
    public function addActivity(
        ActivityBusiness $activityBusiness,
        #[MapRequestPayload] NewActivity $newActivity
    ): Response
    {
        $activity = $activityBusiness->addActivity($newActivity);

        return $this->json($activity, 201, [], ['groups' => '*']);
    }

    #[Route('/{activity}', methods: ['DELETE'])]
    public function delEquipment(ActivityBusiness $activityBusiness, Activity $activity): Response
    {
        $activityBusiness->delActivity($activity);

        return new Response();
    }

    #[Route('/{activity}', methods: ['PUT'])]
    public function updateActivity(
        ActivityBusiness $activityBusiness,
        Activity $activity,
        #[MapRequestPayload] UpdateActivity $updateActivity
    ): Response
    {
        $activityBusiness->updateActivity($activity, $updateActivity);

        return new Response();
    }

    #[Route('/{user}', methods: ['GET'])]
    public function getActivityByUser(ActivityBusiness $activityBusiness, User $user): Response
    {
        $activity = $activityBusiness->getActivityByUser($user);

        return $this->json($activity, 200, [], ['groups' => '*']);
    }
}