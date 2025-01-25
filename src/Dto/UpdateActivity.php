<?php

namespace App\Dto;

class UpdateActivity
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?\DateTime $departureTime = null,
        public ?\DateTime $arrivalTime = null,
        public ?float $distance = null,
        public ?float $speedAverage = null,
        public ?float $speedMax = null,
        public ?int $heightDifference = null,
        public ?int $powerAverage = null,
        public ?int $caloriesConsumed = null,
        public ?int $activityTypeId = null,
        public ?int $equipmentId = null,
        public ?int $difficultyId = null,
        public ?int $userId = null,
    )
    {}
}