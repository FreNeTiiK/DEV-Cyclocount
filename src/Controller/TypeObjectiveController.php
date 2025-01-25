<?php

namespace App\Controller;

use App\Business\TypeObjectiveBusiness;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/typeObjectives')]
class TypeObjectiveController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getTypeObjectives(TypeObjectiveBusiness $typeObjectiveBusiness): Response
    {
        $typeObjectives = $typeObjectiveBusiness->getTypeObjectives();

        return $this->json($typeObjectives, 200, [], ['groups' => '*']);
    }
}