<?php

namespace App\Dto;

class NewUser
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $username,
        public string $password,
        public ?\DateTime $birthday = null,
        public ?string $address = null,
    )
    {}
}