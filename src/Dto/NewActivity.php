<?php

namespace App\Dto;

class NewActivity
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ?\DateTime $departureTime,
        public ?\DateTime $arrivalTime,
        public ?float $distance,
        public ?float $speedAverage,
        public ?float $speedMax,
        public ?int $heightDifference,
        public ?int $powerAverage,
        public ?int $caloriesConsumed,
        public int $activityTypeId,
        public ?int $equipmentId,
        public ?int $difficultyId,
        public int $userId
    )
    {}
}