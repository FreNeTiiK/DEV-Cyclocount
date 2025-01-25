<?php

namespace App\Controller;

use App\Business\AnnualObjectiveBusiness;
use App\Dto\NewAnnualObjective;
use App\Dto\UpdateAnnualObjective;
use App\Entity\AnnualObjective;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/annualObjectives')]
class AnnualObjectiveController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getAnnualObjectives(AnnualObjectiveBusiness $annualObjectiveBusiness): Response
    {
        $annualObjectives = $annualObjectiveBusiness->getAnnualObjectives();

        return $this->json($annualObjectives, 200, [], ['groups' => '*']);
    }

    #[Route('/{user}', methods: ['GET'])]
    public function getAnnualObjectivesByUser(
        AnnualObjectiveBusiness $annualObjectiveBusiness,
        User $user
    ): Response
    {
        $annualObjectives = $annualObjectiveBusiness->getAnnualObjectivesByUser($user);

        return $this->json($annualObjectives, 200, [], ['groups' => '*']);
    }

    #[Route('', methods: ['POST'])]
    public function addAnnualObjective(
        AnnualObjectiveBusiness $annualObjectiveBusiness,
        #[MapRequestPayload] NewAnnualObjective $newAnnualObjective
    ): Response
    {
        $annualObjective = $annualObjectiveBusiness->addAnnualObjective($newAnnualObjective);

        return $this->json($annualObjective, 201, [], ['groups' => '*']);
    }

    #[Route('/{annualObjective}', methods: ['PUT'])]
    public function updateAnnualObjective(
        AnnualObjectiveBusiness $annualObjectiveBusiness,
        AnnualObjective $annualObjective,
        #[MapRequestPayload] UpdateAnnualObjective $updateAnnualObjective
    ): Response
    {
        $annualObjective = $annualObjectiveBusiness->updateAnnualObjective($annualObjective, $updateAnnualObjective);

        return $this->json($annualObjective, 200, [], ['groups' => '*']);
    }

    #[Route('/{annualObjective}', methods: ['DELETE'])]
    public function delAnnualObjective(
        AnnualObjectiveBusiness $annualObjectiveBusiness,
        AnnualObjective $annualObjective
    ): Response
    {
        $annualObjectiveBusiness->delAnnualObjective($annualObjective);

        return new Response();
    }
}