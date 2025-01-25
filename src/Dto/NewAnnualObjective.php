<?php

namespace App\Dto;

class NewAnnualObjective
{
    public function __construct(
        public string $name,
        public int $quantity,
        public ?int $activityTypeId,
        public int $typeObjectiveId,
        public int $userId
    )
    {}
}