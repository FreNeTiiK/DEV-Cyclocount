<?php


namespace App\Business;


use App\Repository\DifficultyRepository;

class DifficultyBusiness
{
    private $difficultyRepository;

    public function __construct
    (
        DifficultyRepository $difficultyRepository
    )
    {
        $this->difficultyRepository = $difficultyRepository;
    }

    public function getDifficulties(): array
    {
        return $this->difficultyRepository->findAll();
    }
}