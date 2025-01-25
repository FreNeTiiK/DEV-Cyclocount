<?php

namespace App\Dto;

class Login
{
    public function __construct(
        public string $username,
        public string $password
    )
    {}
}
