<?php

namespace App\Business;

use App\Repository\DifficultyRepository;

readonly class DifficultyBusiness
{
    public function __construct(
        private DifficultyRepository $difficultyRepository
    )
    {}

    public function getDifficulties(): array
    {
        return $this->difficultyRepository->findAll();
    }
}