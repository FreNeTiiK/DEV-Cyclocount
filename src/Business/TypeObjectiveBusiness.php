<?php

namespace App\Business;

use App\Repository\TypeObjectiveRepository;

readonly class TypeObjectiveBusiness
{
    public function __construct(
        private TypeObjectiveRepository $typeObjectiveRepository
    )
    {}

    public function getTypeObjectives(): array
    {
        return $this->typeObjectiveRepository->findAll();
    }
}