<?php


namespace App\Business;


use App\Repository\TypeObjectiveRepository;

class TypeObjectiveBusiness
{
    private $typeObjectiveRepository;

    public function __construct
    (
        TypeObjectiveRepository $typeObjectiveRepository
    )
    {
        $this->typeObjectiveRepository = $typeObjectiveRepository;
    }

    public function getTypeObjectives(): array
    {
        return $this->typeObjectiveRepository->findAll();
    }
}