<?php

namespace App\Business;

use App\Repository\ActivityTypeRepository;

class ActivityTypeBusiness
{
    private $activityTypeRepository;

    public function __construct
    (
        ActivityTypeRepository $activityTypeRepository
    )
    {
        $this->activityTypeRepository = $activityTypeRepository;
    }

    public function getActivityTypes(): array
    {
        return $this->activityTypeRepository->findAll();
    }
}