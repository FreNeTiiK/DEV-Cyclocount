<?php

namespace App\Controller;

use App\Business\DifficultyBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/difficulties')]
class DifficultyController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getDifficulty(DifficultyBusiness $difficultyBusiness): Response
    {
        $difficulty = $difficultyBusiness->getDifficulties();

        return $this->json($difficulty, 200, [], ['groups' => '*']);
    }

}