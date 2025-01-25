<?php

namespace App\Business;

use App\Repository\ActivityTypeRepository;

readonly class ActivityTypeBusiness
{
    public function __construct(
        private ActivityTypeRepository $activityTypeRepository
    )
    {}

    public function getActivityTypes(): array
    {
        return $this->activityTypeRepository->findAll();
    }
}