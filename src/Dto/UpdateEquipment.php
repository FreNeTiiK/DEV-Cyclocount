<?php

namespace App\Dto;

class UpdateEquipment
{
    public function __construct(
        public string $name,
        public ?int $activityTypeId,
        public ?int $userId,
    )
    {}
}