<?php

namespace App\Dto;

class UpdateAnnualObjective
{
    public function __construct(
        public ?string $name = null,
        public ?int $quantity = null,
        public ?int $activityTypeId = null,
        public ?int $typeObjectiveId = null,
        public ?int $userId = null,
    )
    {}
}