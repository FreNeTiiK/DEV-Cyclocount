<?php

namespace App\Controller;

use App\Business\ActivityTypeBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/activityTypes')]
class ActivityTypeController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getActivityTypes(ActivityTypeBusiness $activityTypeBusiness): Response
    {
        $activityTypes = $activityTypeBusiness->getActivityTypes();

        return $this->json($activityTypes, 200, [], ['groups' => '*']);
    }
}