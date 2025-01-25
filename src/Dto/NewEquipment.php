<?php

namespace App\Dto;

class NewEquipment
{
    public function __construct(
        public string $name,
        public int $activityTypeId,
        public int $userId
    )
    {}
}