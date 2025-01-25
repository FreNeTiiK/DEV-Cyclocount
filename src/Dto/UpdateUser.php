<?php

namespace App\Dto;

class UpdateUser
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $username = null,
        public ?\DateTime $birthday = null,
        public ?string $address = null,
    )
    {}
}