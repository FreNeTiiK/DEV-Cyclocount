<?php

namespace App\Dto;

class ChangePasswordUser
{
    public function __construct(
        public string $currentPassword,
        public string $newPassword
    )
    {}
}