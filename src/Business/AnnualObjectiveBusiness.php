<?php

namespace App\Business;

use App\Dto\NewAnnualObjective;
use App\Dto\UpdateAnnualObjective;
use App\Entity\AnnualObjective;
use App\Entity\User;
use App\Repository\ActivityTypeRepository;
use App\Repository\AnnualObjectiveRepository;
use App\Repository\TypeObjectiveRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class AnnualObjectiveBusiness
{
    public function __construct(
        private AnnualObjectiveRepository $annualObjectiveRepository,
        private TypeObjectiveRepository $typeObjectiveRepository,
        private ActivityTypeRepository $activityTypeRepository,
        private UserRepository $userRepository,
        private EntityManagerInterface $em
    )
    {}

    public function getAnnualObjectives(): array
    {
        return $this->annualObjectiveRepository->findAll();
    }

    public function getAnnualObjectivesByUser(User $user): array
    {
        return $this->annualObjectiveRepository->findBy(['userLink' => $user]);
    }

    public function addAnnualObjective(NewAnnualObjective $newAnnualObjective): AnnualObjective
    {
        $user = $this->userRepository->find($newAnnualObjective->userId);
        $typeObjective = $this->typeObjectiveRepository->find($newAnnualObjective->typeObjectiveId);

        $annualObjective = new AnnualObjective();
        $annualObjective->setName($newAnnualObjective->name);
        $annualObjective->setQuantity($newAnnualObjective->quantity);
        $annualObjective->setTypeObjective($typeObjective);
        $annualObjective->setUserLink($user);
        if ($newAnnualObjective->activityTypeId !== null) {
            $activityType = $this->activityTypeRepository->find($newAnnualObjective->activityTypeId);
            $annualObjective->setActivityType($activityType);
        }
        $this->em->persist($annualObjective);
        $this->em->flush();

        return $annualObjective;
    }

    public function updateAnnualObjective(AnnualObjective $annualObjective, UpdateAnnualObjective $updateAnnualObjective): AnnualObjective
    {
        $updateAnnualObjective->name === null ?: $annualObjective->setName($updateAnnualObjective->name);
        $updateAnnualObjective->quantity === null ?: $annualObjective->setQuantity($updateAnnualObjective->quantity);
        if ($updateAnnualObjective->activityTypeId !== null) {
            $activityType = $this->activityTypeRepository->find($updateAnnualObjective->activityTypeId);
            $annualObjective->setActivityType($activityType);
        }
        if ($updateAnnualObjective->typeObjectiveId !== null) {
            $typeObjective = $this->typeObjectiveRepository->find($updateAnnualObjective->typeObjectiveId);
            $annualObjective->setTypeObjective($typeObjective);
        }
        if ($updateAnnualObjective->userId !== null) {
            $user = $this->userRepository->find($updateAnnualObjective->userId);
            $annualObjective->setUserLink($user);
        }
        $this->em->persist($annualObjective);
        $this->em->flush();

        return $annualObjective;
    }

    public function delAnnualObjective(AnnualObjective $annualObjective): void
    {
        $this->em->remove($annualObjective);
        $this->em->flush();
    }
}